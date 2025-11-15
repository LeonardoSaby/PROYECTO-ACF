<?php

namespace App\Http\Controllers;

use App\Models\Inscripcione;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\InscripcioneRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Infante;
use App\Models\Curso;
use App\Models\Turno;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class InscripcioneController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $inscripciones = Inscripcione::with(['infante', 'curso', 'turno'])
            ->when($search, function ($query, $search) {
                $query->whereHas('infante', function ($q) use ($search) {
                    $q->where('nombre_infante', 'like', "%{$search}%")
                    ->orWhere('apellido_infante', 'like', "%{$search}%");
                })->orWhereHas('curso', function ($q) use ($search) {
                    $q->where('nombre_curso', 'like', "%{$search}%");
                })->orWhereHas('turno', function ($q) use ($search) {
                    $q->where('nombre_turno', 'like', "%{$search}%");
                });
            })
            ->orderBy('inscripcion_id', 'DESC') // ← aquí el cambio
            ->paginate(1000);

        $cursos = Curso::all();
        $turnos = Turno::all();

        return view('inscripcione.index', compact('inscripciones', 'cursos', 'turnos'))
            ->with('i', ($request->input('page', 1) - 1) * $inscripciones->perPage());
    }


    public function create(): View
    {
        $inscripcione = new Inscripcione(); 
        $infantes = Infante::all();
        $cursos = Curso::all();
        $turnos = Turno::all();

        return view('inscripcione.create', compact('inscripcione', 'infantes', 'cursos', 'turnos'));
    }

    public function store(InscripcioneRequest $request): RedirectResponse
{
    DB::beginTransaction();

    try {

        // ✅ Validación: impedir inscripción duplicada en el mismo año
        $existe = Inscripcione::where('infante_id', $request->infante_id)
                    ->whereYear('fecha', now()->year)
                    ->exists();

        if ($existe) {
            return Redirect::back()
                ->with('error', 'Este infante ya está inscrito en la gestión ' . now()->year . '.');
        }

        // Buscar los registros relacionados
        $infante = Infante::findOrFail($request->infante_id);
        $curso   = Curso::findOrFail($request->curso_id);
        $turno   = Turno::findOrFail($request->turno_id);

        // Crear inscripción
        Inscripcione::create([
            'infante_id' => $infante->infante_id,
            'curso_id'   => $curso->curso_id,
            'turno_id'   => $turno->turno_id,
            'fecha'      => now(),
        ]);

        DB::commit();

        return Redirect::route('inscripciones.index')
            ->with('success', 'Inscripción registrada correctamente.');
    } 
    catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        DB::rollBack();
        return Redirect::route('inscripciones.index')
            ->with('error', 'No se encontró uno de los elementos relacionados (Infante, Curso o Turno).');
    } 
    catch (\Exception $e) {
        DB::rollBack();
        return Redirect::route('inscripciones.index')
            ->with('error', 'Error al registrar la inscripción: ' . $e->getMessage());
    }
}

    public function show($inscripcion_id): View
    {
        $inscripcione = Inscripcione::with(['infante', 'curso', 'turno'])->findOrFail($inscripcion_id);
        return view('inscripcione.show', compact('inscripcione'));
    }

    public function edit($inscripcion_id): View
    {
        $inscripcione = Inscripcione::findOrFail($inscripcion_id);
        $infantes = Infante::all();
        $cursos = Curso::all();
        $turnos = Turno::all();

        return view('inscripcione.edit', compact('inscripcione', 'infantes', 'cursos', 'turnos'));
    }

    public function update(InscripcioneRequest $request, Inscripcione $inscripcione): RedirectResponse
    {
        $inscripcione->update($request->validated());

        return Redirect::route('inscripciones.index')
            ->with('success', 'Inscripción actualizada correctamente.');
    }

    public function destroy($inscripcion_id): RedirectResponse
    {
        $inscripcion = Inscripcione::findOrFail($inscripcion_id);
        $inscripcion->delete();
        return Redirect::route('inscripciones.index')
            ->with('success', 'Inscripción eliminada correctamente.');
    }
/*
     public function listaGeneralPDF()
    {
        $inscritos = Inscripcione::with(['infante','curso','turno'])
                        ->orderBy('curso_id')
                        ->orderBy('turno_id')
                        ->get();

        $pdf = Pdf::loadView('reportes.lista_general_pdf', compact('inscritos'));
        return $pdf->stream('inscritos_lista_general.pdf'); // o download(...)
    }

    // --- Formulario para filtrar por curso/turno ---
    public function formListaPorCurso()
    {
        $cursos = Curso::all();
        $turnos = Turno::all();
        return view('reportes.form_lista_por_curso', compact('cursos','turnos'));
    }

    // --- Lista por curso y turno en PDF ---
    public function listaPorCursoPDF(Request $request)
    {
        $request->validate([
            'curso_id' => 'nullable|exists:cursos,id',
            'turno_id' => 'nullable|exists:turnos,id',
        ]);

        $query = Inscripcione::with(['infante','curso','turno']);

        if ($request->filled('curso_id')) {
            $query->where('curso_id', $request->curso_id);
        }

        if ($request->filled('turno_id')) {
            $query->where('turno_id', $request->turno_id);
        }

        $inscritos = $query->orderBy('curso_id')->orderBy('turno_id')->get();

        $pdf = Pdf::loadView('reportes.lista_por_curso_pdf', compact('inscritos','request'));
        return $pdf->stream('inscritos_por_curso.pdf');
    }**/
}
    