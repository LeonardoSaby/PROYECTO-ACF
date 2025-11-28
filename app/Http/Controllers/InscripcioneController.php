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
                })
                ->orWhereHas('curso', fn($q) => $q->where('nombre_curso', 'like', "%{$search}%"))
                ->orWhereHas('turno', fn($q) => $q->where('nombre_turno', 'like', "%{$search}%"));
            })
            ->orderBy('inscripcion_id', 'DESC')
            ->paginate(1000);

        $cursos = Curso::all();
        $turnos = Turno::all();
        return view('inscripcione.index', compact('inscripciones', 'cursos', 'turnos'))
            ->with('i', ($request->input('page', 1) - 1) * $inscripciones->perPage());
    }

    public function show($inscripcion_id): View
    {
        $inscripcione = Inscripcione::with(['infante', 'curso', 'turno'])->findOrFail($inscripcion_id);
        return view('inscripcione.show', compact('inscripcione'));
    }

    public function create(): View
    {
        return view('inscripcione.create', [
            'inscripcione' => new Inscripcione(),
            'infantes' => Infante::all(),
            'cursos' => Curso::all(),
            'turnos' => Turno::all(),
        ]);
    }

    public function store(InscripcioneRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            Inscripcione::create([
                'infante_id' => $request->infante_id,
                'curso_id'   => $request->curso_id,
                'turno_id'   => $request->turno_id,
                'fecha'      => now(),
            ]);
            DB::commit();
            return Redirect::route('inscripciones.index')
                ->with('success', 'Inscripción registrada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::route('inscripciones.index')
                ->with('error', 'Error al registrar la inscripción.');
        }
    }

    public function edit($inscripcion_id): View
    {
        return view('inscripcione.edit', [
            'inscripcione' => Inscripcione::findOrFail($inscripcion_id),
            'infantes' => Infante::all(),
            'cursos' => Curso::all(),
            'turnos' => Turno::all(),
        ]);
    }

    public function update(InscripcioneRequest $request, Inscripcione $inscripcione): RedirectResponse
    {
        $inscripcione->update($request->validated());
        return Redirect::route('inscripciones.index')
            ->with('success', 'Inscripción actualizada correctamente.');
    }

    public function destroy($inscripcion_id): RedirectResponse
    {
        Inscripcione::findOrFail($inscripcion_id)->delete();
        return Redirect::route('inscripciones.index')
            ->with('success', 'Inscripción eliminada correctamente.');
    }
}
