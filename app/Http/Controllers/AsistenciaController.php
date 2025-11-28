<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\DetalleAsistencia;
use App\Models\Curso;
use App\Models\Turno;
use App\Models\Inscripcione;

class AsistenciaController extends Controller
{
    // === Listado de asistencias ===
    public function index(Request $request)
    {
        $asistencias = Asistencia::orderBy('fecha', 'desc')->get();
        $cursos = Curso::all();
        $turnos = Turno::all();

        return view('asistencias.index', compact('asistencias', 'cursos', 'turnos'));
    }

    // === Genera la lista de asistencia para marcar (vista create) ===
    public function generarAsistencia(Request $request)
    {
        // Obtener parámetros desde query string
        $fecha = $request->query('fecha');
        $curso_id = $request->query('curso_id');
        $turno_id = $request->query('turno_id');

        // Validación básica
        if (!$fecha || !$curso_id || !$turno_id) {
            return redirect()->back()->with('error', 'Debe seleccionar fecha, curso y turno.');
        }

        // Validar que existan curso y turno
        $curso = Curso::find($curso_id);
        $turno = Turno::find($turno_id);
        if (!$curso || !$turno) {
            return redirect()->back()->with('error', 'Curso o turno no válido.');
        }

        // Evitar duplicados: buscar asistencia existente
        $existe = Asistencia::where('fecha', $fecha)
            ->whereHas('detalleAsistencias.inscripcion', function ($q) use ($curso_id, $turno_id) {
                $q->where('curso_id', $curso_id)
                  ->where('turno_id', $turno_id);
            })
            ->exists();

        if ($existe) {
            return redirect()->back()->with('warning', 'Ya se generó la asistencia para este curso y turno este dia.');
        }

        // Obtener inscripciones del curso y turno
        $inscripciones = Inscripcione::with('infante')
            ->where('curso_id', $curso_id)
            ->where('turno_id', $turno_id)
            ->get();

        if ($inscripciones->isEmpty()) {
            return redirect()->back()->with('warning', 'No hay inscripciones para el curso y turno seleccionados.');
        }

        // Mostrar formulario de creación de asistencia
        return view('asistencias.create', compact('fecha', 'curso', 'turno', 'inscripciones'));
    }

    // === Guarda la asistencia y sus detalles ===
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'detalles' => 'required|array',
            'detalles.*' => 'required|in:presente,ausente,licencia',
        ]);

        $fecha = $request->fecha;

        // Validar duplicado (tomando el primer inscripcion_id para identificar curso/turno)
        $primer_inscripcion_id = array_keys($request->detalles)[0] ?? null;
        $inscripcion = Inscripcione::find($primer_inscripcion_id);
        if ($inscripcion) {
            $existe = Asistencia::where('fecha', $fecha)
                ->whereHas('detalleAsistencias.inscripcion', function($q) use ($inscripcion) {
                    $q->where('curso_id', $inscripcion->curso_id)
                      ->where('turno_id', $inscripcion->turno_id);
                })->exists();

            if ($existe) {
                return redirect()->back()->with('warning', 'Ya se registró la asistencia para este curso y turno en esta fecha.');
            }
        }

        // Crear cabecera de asistencia
        $asistencia = Asistencia::create(['fecha' => $fecha]);

        // Crear detalles
        foreach ($request->detalles as $inscripcion_id => $observacion) {
            DetalleAsistencia::create([
                'asistencia_id' => $asistencia->asistencia_id,
                'inscripcion_id' => $inscripcion_id,
                'observacion' => $observacion,
            ]);
        }

        return redirect()->route('asistencias.index')->with('success', 'Lista de asistencia registrada correctamente.');
    }

    // === Mostrar detalles de una asistencia ===
    public function show(Asistencia $asistencia)
    {
        $detalle = $asistencia->detalleAsistencias()->with('inscripcion.infante', 'inscripcion.curso', 'inscripcion.turno')->get();
        return view('asistencias.show', compact('asistencia', 'detalle'));
    }

    // === Editar observaciones ===
    public function edit(Asistencia $asistencia)
    {
        $detalle = $asistencia->detalleAsistencias()->with('inscripcion.infante')->get();
        return view('asistencias.edit', compact('asistencia', 'detalle'));
    }

    public function update(Request $request, Asistencia $asistencia)
    {
        $request->validate([
            'observaciones' => 'required|array',
            'observaciones.*' => 'required|in:presente,ausente,licencia',
        ]);

        foreach ($request->observaciones as $detalle_id => $observacion) {
            $detalle = DetalleAsistencia::find($detalle_id);
            if ($detalle) {
                $detalle->update(['observacion' => $observacion]);
            }
        }

        return redirect()->route('asistencias.index')->with('success', 'Asistencia actualizada correctamente.');
    }

    // === Eliminar asistencia ===
    public function destroy(Asistencia $asistencia)
    {
        $asistencia->update(['estado' => 'inactivo']);
        return redirect()->route('asistencias.index')->with('success', 'Asistencia eliminada correctamente.');
    }
}
