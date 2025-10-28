<?php

namespace App\Http\Controllers;

use App\Models\Infante;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\InfanteRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class InfanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');
        

        $infantes = Infante::query()
            -> where ('estado', 'Activo')

            ->when($search, function ($query, $search) {
                return $query->where('nombre_infante', 'like', "%{$search}%")
                             ->orWhere('apellido_infante', 'like', "%{$search}%")
                             ->orWhere('CI_infante', 'like', "%{$search}%");
            })->paginate(10);

        return view('infante.index', compact('infantes', 'search'))
         ->with('i', (request()->input('page', 1) - 1) * $infantes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $infante = new Infante();

        return view('infante.create', compact('infante'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InfanteRequest $request): RedirectResponse
    {
        Infante::create($request->validated());

        return Redirect::route('infantes.index')
            ->with('success', 'Infante created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $infante = Infante::find($id);

        return view('infante.show', compact('infante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $infante = Infante::find($id);

        return view('infante.edit', compact('infante'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InfanteRequest $request, Infante $infante): RedirectResponse
    {
        $infante->update($request->validated());

        return Redirect::route('infantes.index')
            ->with('success', 'Infante updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        /*Infante::find($id)->delete();

        return Redirect::route('infantes.index')
            ->with('success', 'Infante deleted successfully');
            */

        $infante = Infante::find($id);
        if ($infante) {
            $infante->update(['estado' => 'Inactivo']);

            return Redirect::route('infantes.index')
                ->with('success', 'Infante desactivado exitosamente');
        }
        return Redirect::route('infantes.index')
            ->with('error', 'Infante no encontrado');
        
    }
}
