<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CursoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Nivele;
use App\Models\Sala;
use App\Models\Docente;

class CursoController extends Controller
{
    /**
     * Muestra el listado de cursos.
     */
    public function index(Request $request): View
    {
        $cursos = Curso::paginate();

        return view('curso.index', compact('cursos'))
            ->with('i', ($request->input('page', 1) - 1) * $cursos->perPage());
    }

    /**
     * Muestra el formulario para crear un nuevo curso.
     */
    public function create(): View
    {
        $curso = new Curso();
        $niveles = Nivele::all();
        $salas = Sala::all();
        $docentes = Docente::all();

        return view('curso.create', compact('niveles','salas','docentes','curso'));
    }

    /**
     * Guarda un nuevo curso en la base de datos.
     */
    public function store(CursoRequest $request): RedirectResponse
    {
        Curso::create($request->validated());

        return Redirect::route('cursos.index')
            ->with('success', 'Curso creado correctamente.');
    }

    /**
     * Muestra la información de un curso específico.
     */
    public function show($id): View
    {
        $curso = Curso::find($id);

        return view('curso.show', compact('curso'));
    }

    /**
     * Muestra el formulario de edición de un curso.
     */
    public function edit($id): View
    {
        $curso = Curso::find($id);
        $niveles = Nivele::all();
        $salas = Sala::all();
        $docentes = Docente::all();

        return view('curso.edit', compact('curso','niveles','salas','docentes'));
    }

    /**
     * Actualiza un curso en la base de datos.
     */
    public function update(CursoRequest $request, Curso $curso): RedirectResponse
    {
        $curso->update($request->validated());

        return Redirect::route('cursos.index')
            ->with('success', 'Curso actualizado correctamente.');
    }

    /**
     * Elimina un curso de la base de datos.
     */
    public function destroy($id): RedirectResponse
    {
        Curso::find($id)->delete();

        return Redirect::route('cursos.index')
            ->with('success', 'Curso eliminado correctamente.');
    }
}
