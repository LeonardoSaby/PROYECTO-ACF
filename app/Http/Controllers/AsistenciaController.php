<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\DetalleAsistencia;
use App\Models\Curso; 
use App\Models\Turno; 
use App\Models\Inscripcione; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AsistenciaController extends Controller
{
    /**
     * Muestra el historial de asistencias registradas.
     */
    public function index(): View
    {
        $asistencias = Asistencia::paginate(10); 

        return view('asistencia.index', compact('asistencias'))
            ->with('i', (request()->input('page', 1) - 1) * $asistencias->perPage());
    }

    /**
     * Muestra el formulario de dos pasos para la toma de asistencia.
     * Carga los datos necesarios para los filtros (Cursos, Turnos).
     */
    public function create(): View
    {
        // **CORRECCIÓN 1:** Usamos all() en lugar de pluck() para que la vista reciba OBJETOS.
        $cursos = Curso::all(); 
        $turnos = Turno::all(); 

        return view('asistencia.create', compact('cursos', 'turnos'));
    }

    /**
     * FUNCIÓN AJAX: Genera la tabla de infantes inscritos
     * basándose en Curso, Turno y la Fecha seleccionada.
     */
    public function generarLista(Request $request)
    {
                $request->validate([
            // Las columnas en inscripciones son 'curso_id' y 'turno_id'
            'curso_id' => 'required|exists:cursos,id',
            'turno_id' => 'required|exists:turnos,id',
            'fecha'    => 'required|date',
        ]);

        $curso_id = $request->input('curso_id');
        $id_turno = $request->input('id_turno'); // Usamos id_turno aquí y en el AJAX
        $fecha = $request->input('fecha');

        // 1. Verificar si ya existe una asistencia para ESTA combinación (Curso/Turno/Fecha)
        $asistenciaExistente = Asistencia::where('fecha', $fecha)
            ->whereHas('detalleAsistencias.inscripcion', function ($query) use ($curso_id, $id_turno) {
                // Consultamos las columnas de la tabla 'inscripciones'
                $query->where('curso_id', $curso_id)
                      ->where('id_turno', $id_turno );
            })
            ->first();

        if ($asistenciaExistente) {
            return response()->json([
                'error' => true,
                'message' => 'Ya existe un registro de asistencia para este Curso, Turno y Fecha. Use la opción Editar.',
                'id_asistencia' => $asistenciaExistente->id_asistencia 
            ], 409); // Código 409 Conflict
        }

        // 2. Si no existe, cargar las Inscripciones activas para el Curso y Turno
        $inscripciones = Inscripcione::with('infante') 
            ->where('curso_id', $curso_id)
            ->where('id_turno', $id_turno) // Usamos la columna real de la tabla inscripciones
            ->where('estado', 'Activa') 
            ->get();
        
        if ($inscripciones->isEmpty()) {
            return response()->json(['error' => true, 'message' => 'No se encontraron infantes inscritos para esta selección.'], 404);
        }

        // 3. Renderizar la tabla dinámica
        // La variable que se pasa a la vista parcial debe ser $inscripciones
        $html = view('asistencia.partes.tabla_detalles', compact('inscripciones'))->render();

        return response()->json([
            'error' => false,
            'html' => $html,
            'message' => 'Lista de asistencia generada exitosamente.'
        ]);
    }

    /**
     * Procesa la solicitud y guarda la cabecera (Asistencia) y todos los detalles.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'fecha' => 'required|date',
            // Corregido: La vista envía los datos bajo la clave 'detalles', no 'infantes'
            'detalles' => 'required|array', 
            'detalles.*.id_inscripcion' => 'required|exists:inscripciones,id_inscripcion',
            'detalles.*.observaciones' => 'required|in:presente,ausente,justificado',
            'detalles.*.observaciones_adicionales' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // 1. Crear la cabecera de Asistencia
            $asistencia = Asistencia::create([
                'fecha' => $data['fecha'],
                'status' => 'activo',
            ]);

            // 2. Preparar los Detalles (DetalleAsistencia)
            $detalleAsistenciasData = [];
            // Iteramos sobre el array 'detalles'
            foreach ($data['detalles'] as $detalle) {
                $detalleAsistenciasData[] = [
                    'id_asistencia' => $asistencia->id_asistencia,
                    'id_inscripcion' => $detalle['id_inscripcion'],
                    'observaciones' => $detalle['observaciones'], 
                    'observaciones_adicionales' => $detalle['observaciones_adicionales'] ?? null,
                    'estado' => 'activo', 
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // 3. Guardar los Detalles masivamente
            DetalleAsistencia::insert($detalleAsistenciasData);

            DB::commit();

            return redirect()->route('asistencias.index')
                ->with('success', 'Asistencia registrada con éxito para la fecha: ' . $asistencia->fecha);

        } catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage()); // Para depuración
            return redirect()->back()
                ->with('error', 'Error al registrar la asistencia. Intente de nuevo. Detalle: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Muestra el detalle completo de una Asistencia (un día/grupo).
     */
    public function show($id_asistencia): View
    {
        // Cargar la cabecera y todos sus detalles (con las inscripciones y infantes relacionados)
        $asistencia = Asistencia::with([
            'detalleAsistencias.inscripcion.infante',
            'detalleAsistencias.inscripcion.curso',
            'detalleAsistencias.inscripcion.turno',
        ])
        ->findOrFail($id_asistencia);
        
        // Determinar un curso y turno de referencia de la primera inscripción, si existe
        $referencia = $asistencia->detalleAsistencias->first()?->inscripcion;

        return view('asistencia.show', compact('asistencia', 'referencia'));
    }

    /**
     * Muestra el formulario para editar la asistencia.
     */
    public function edit($id_asistencia): View
    {
        $asistencia = Asistencia::with([
            'detalleAsistencias.inscripcion.infante',
            'detalleAsistencias.inscripcion.curso',
            'detalleAsistencias.inscripcion.turno',
        ])
        ->findOrFail($id_asistencia);
        
        $referencia = $asistencia->detalleAsistencias->first()?->inscripcion;
        
        return view('asistencia.edit', compact('asistencia', 'referencia'));
    }

    /**
     * Actualiza la asistencia (maestro y/o detalles).
     */
    public function update(Request $request, $id_asistencia): RedirectResponse
    {
        $data = $request->validate([
            'fecha' => 'required|date',
            'detalles' => 'required|array',
            'detalles.*.id_detalle' => 'required|exists:detalle_asistencias,id_detalle_asistencia',
            'detalles.*.observaciones' => 'required|in:presente,ausente,justificado',
            'detalles.*.observaciones_adicionales' => 'nullable|string',
        ]);
        
        try {
            DB::beginTransaction();

            // 1. Actualizar detalles masivamente
            foreach ($data['detalles'] as $id_detalle => $detalleData) {
                // Usamos el ID del detalle de asistencia como clave
                DetalleAsistencia::where('id_detalle_asistencia', $id_detalle)
                    ->update([
                        'observaciones' => $detalleData['observaciones'],
                        'observaciones_adicionales' => $detalleData['observaciones_adicionales'] ?? null,
                        'updated_at' => now(),
                    ]);
            }
            
            DB::commit();

            return redirect()->route('asistencias.index')
                ->with('success', 'Asistencia actualizada con éxito.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error al actualizar la asistencia. Detalle: ' . $e->getMessage());
        }
    }

    /**
     * Elimina lógicamente un registro de asistencia completo.
     */
    public function destroy(Asistencia $asistencia): RedirectResponse
    {
        // Eliminado lógico en la cabecera
        $asistencia->update(['status' => 'inactivo']);

        // Eliminado lógico en todos los detalles asociados
        $asistencia->detalleAsistencias()->update(['estado' => 'inactivo']);

        return redirect()->route('asistencias.index')
            ->with('success', 'Asistencia eliminada lógicamente con éxito.');
    }
}