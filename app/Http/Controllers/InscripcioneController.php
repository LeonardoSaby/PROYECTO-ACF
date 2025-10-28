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
                })->orWhereHas('curso', function ($q) use ($search) {
                    $q->where('nombre_curso', 'like', "%{$search}%");
                })->orWhereHas('turno', function ($q) use ($search) {
                    $q->where('nombre_turno', 'like', "%{$search}%");
                });
            })
            ->orderBy('id', 'DESC')
            ->paginate(5);

        return view('inscripcione.index', compact('inscripciones'))
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
            // Buscar los registros relacionados
            $infante = Infante::findOrFail($request->infante_id);
            $curso   = Curso::findOrFail($request->curso_id);
            $turno   = Turno::findOrFail($request->turno_id);

            // Crear inscripción
            Inscripcione::create([
                'infante_id' => $infante->id,
                'curso_id'   => $curso->id,
                'turno_id'   => $turno->id,
                'fecha'      => now(),
            ]);

            DB::commit();

            return Redirect::route('inscripciones.index')
                ->with('success', 'Inscripción registrada correctamente.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return Redirect::route('inscripciones.index')
                ->with('error', 'No se encontró uno de los elementos relacionados (Infante, Curso o Turno).');
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::route('inscripciones.index')
                ->with('error', 'Error al registrar la inscripción: ' . $e->getMessage());
        }
    }

    public function show($id): View
    {
        $inscripcione = Inscripcione::with(['infante', 'curso', 'turno'])->findOrFail($id);
        return view('inscripcione.show', compact('inscripcione'));
    }

    public function edit($id): View
    {
        $inscripcione = Inscripcione::findOrFail($id);
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

    public function destroy($id): RedirectResponse
    {
        Inscripcione::findOrFail($id)->delete();

        return Redirect::route('inscripciones.index')
            ->with('success', 'Inscripción eliminada correctamente.');
    }
}
    