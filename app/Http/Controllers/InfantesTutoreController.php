<?php

namespace App\Http\Controllers;

use App\Models\InfantesTutore;
use App\Models\Infante;
use App\Models\Tutore;
use Illuminate\Http\Request;
use App\Http\Requests\InfantesTutoreRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class InfantesTutoreController extends Controller
{
    // Listado de asignaciones
    public function index(Request $request): View
    {
        $infantesTutores = InfantesTutore::paginate(1000);

        return view('infantes-tutore.index', compact('infantesTutores'))
            ->with('i', ($request->input('page', 1) - 1) * $infantesTutores->perPage());
    }

    // Formulario para crear asignación
    public function create(): View
    {
        $infantes = Infante::all();
        $tutores = Tutore::all();

        return view('infantes-tutore.create', compact('infantes', 'tutores'));
    }

    // Guardar nueva asignación
    public function store(InfantesTutoreRequest $request)
    {
        InfantesTutore::create($request->validated());

        return Redirect::route('infantes-tutores.index')
            ->with('success', 'Asignación creada correctamente.');
    }

    // Formulario para editar asignación
    public function edit($infante_tutor_id): View
    {
        $infantesTutore = InfantesTutore::findOrFail($infante_tutor_id);
        $infantes = Infante::all();
        $tutores = Tutore::all();

        return view('infantes-tutore.edit', compact('infantesTutore', 'infantes', 'tutores'));
    }

    // Actualizar asignación
    public function update(InfantesTutoreRequest $request, InfantesTutore $infantesTutore)
    {
        $infantesTutore->update($request->validated());

        return Redirect::route('infantes-tutores.index')
            ->with('success', 'Asignación actualizada correctamente.');
    }

    // Eliminar (inactivar) asignación
    public function destroy($infante_tutor_id)
    {
        InfantesTutore::findOrFail($infante_tutor_id)->update(['estado' => 'inactivo']);

        return Redirect::route('infantes-tutores.index')
            ->with('success', 'Asignación eliminada correctamente.');
    }
}
