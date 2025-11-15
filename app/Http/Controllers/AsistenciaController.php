<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAsistenciaRequest;
use App\Models\Asistencia;
use App\Models\DetalleAsistencia;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Turno;
use App\Models\Inscripcione;

class AsistenciaController extends Controller
{
    public function index(Request $request)
    {
        $asistencias = Asistencia::orderBy('fecha', 'desc')->get();
        $cursos = Curso::all();
        $turnos = Turno::all();
        return view('asistencias.index', compact('asistencias', 'cursos', 'turnos'));
    }

    // === Genera la lista de asistencia para marcar ===
    public function generarAsistencia(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'curso_id' => 'required|exists:cursos,curso_id',
            'turno_id' => 'required|exists:turnos,turno_id',
        ]);

        $fecha = $request->fecha;
        $curso_id = $request->curso_id;
        $turno_id = $request->turno_id;

        $curso = Curso::find($curso_id);
        $turno = Turno::find($turno_id);
        $asistencias = new Asistencia();

        // Traer inscripciones que coincidan con curso y turno
        $inscripciones = Inscripcione::with('infante', 'curso', 'turno')
            ->where('curso_id', $curso_id)
            ->where('turno_id', $turno_id)
            ->get();

        if ($inscripciones->isEmpty()) {
            return redirect()->back()->with('warning', 'No hay inscripciones para el curso y turno seleccionados.');
        }

        return view('asistencias.create', compact('asistencias', 'fecha', 'curso', 'turno', 'inscripciones'));
    }

    // === Guarda la asistencia y sus detalles ===
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'detalles' => 'required|array',
            'detalles.*' => 'required|in:presente,ausente,licencia',
        ]);

        // Crear cabecera
        $asistencia = Asistencia::create(['fecha' => $request->fecha]);

        // Crear detalles
        foreach ($request->detalles as $inscripcion_id => $observacion) {
            DetalleAsistencia::create([
                'asistencia_id' => $asistencia->asistencia_id,
                'inscripcion_id' => $inscripcion_id,
                'observacion' => $observacion,
            ]);
        }

        return redirect()->route('asistencias.index')->with('success', 'Asistencia registrada correctamente.');
    }

    // === Mostrar detalles de una asistencia ===
    public function show(Asistencia $asistencia)
    {
        $detalle = $asistencia->detalleAsistencias()->with('inscripcion.infante', 'inscripcion.curso', 'inscripcion.turno')->get();
        return view('asistencias.show', compact('asistencia', 'detalle'));
    }

    // === Editar observaciones (si se requiere) ===
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
