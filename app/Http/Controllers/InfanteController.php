<?php

namespace App\Http\Controllers;

use App\Models\Infante;
use App\Models\Tutore;
use App\Models\InfantesTutore;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\InfanteRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class InfanteController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $infantes = Infante::query()
            ->where('estado', 'Activo')
            ->when($search, function ($query, $search) {
                return $query->where('nombre_infante', 'like', "%{$search}%")
                                ->orWhere('apellido_infante', 'like', "%{$search}%")
                                ->orWhere('CI_infante', 'like', "%{$search}%");
            })
            ->paginate(1000);

        return view('infante.index', compact('infantes', 'search'))
            ->with('i', (request()->input('page', 1) - 1) * $infantes->perPage());
    }

    public function create(): View
    {
        $infante = new Infante();
        $tutores = Tutore::all();
        return view('infante.create', compact('infante', 'tutores'));
    }

    public function store(InfanteRequest $request): RedirectResponse
    {
        $infante = Infante::create($request->validated());
        if ($request->tutores && $request->parentezcos) {
            $syncData = [];
            foreach ($request->tutores as $i => $tutorId) {
                if ($tutorId) {
                    $syncData[$tutorId] = [
                        'parentesco' => $request->parentezcos[$i],
                        'estado' => 'activo'
                    ];
                }
            }
            $infante->tutores()->sync($syncData);
        }
        return redirect()->route('infantes.index')->with('success', 'Infante registrado exitosamente.');
    }


    public function show($infante_id): View
    {
        $infante = Infante::with('tutores')->findOrFail($infante_id);
        return view('infante.show', compact('infante'));
    }

    public function edit($infante_id): View
    {
        $infante = Infante::with('tutores')->findOrFail($infante_id);
        $tutores = Tutore::all();
        return view('infante.edit', compact('infante', 'tutores'));
    }

    public function update(InfanteRequest $request, $id): RedirectResponse
    {
        $infante = Infante::findOrFail($id);
        $infante->update($request->validated());
        if ($request->tutores && $request->parentezcos) {
            $syncData = [];
            foreach ($request->tutores as $i => $tutorId) {
                if ($tutorId) {
                    $syncData[$tutorId] = [
                        'parentesco' => $request->parentezcos[$i],
                        'estado' => 'activo'
                    ];
                }
            }   
            $infante->tutores()->sync($syncData);
        }

        return redirect()->route('infantes.index')->with('success', 'Infante actualizado exitosamente.');
    }

    public function destroy($infante_id): RedirectResponse
    {
        $infante = Infante::find($infante_id);
        if ($infante) {
            $infante->update(['estado' => 'Inactivo']);
            $infante->tutores()->detach();
            return Redirect::route('infantes.index')
                ->with('success', 'Infante desactivado exitosamente.');
        }
        return Redirect::route('infantes.index')
            ->with('error', 'Infante no encontrado.');
    }
}
