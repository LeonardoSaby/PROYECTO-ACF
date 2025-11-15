<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SalaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $salas = Sala::where('estado', 'activo')->paginate();

        return view('sala.index', compact('salas'))
            ->with('i', ($request->input('page', 1) - 1) * $salas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $sala = new Sala();

        return view('sala.create', compact('sala'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalaRequest $request): RedirectResponse
    {
        Sala::create($request->validated());

        return Redirect::route('salas.index')
            ->with('success', 'Sala registrada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($sala_id): View
    {
        $sala = Sala::find($sala_id);

        return view('sala.show', compact('sala'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($sala_id): View
    {
        $sala = Sala::find($sala_id);

        return view('sala.edit', compact('sala'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SalaRequest $request, Sala $sala): RedirectResponse
    {
        $sala->update($request->validated());

        return Redirect::route('salas.index')
            ->with('success', 'Sala modificada exitosamente');
    }

    public function destroy($sala_id): RedirectResponse
    {
        Sala::find($sala_id)->update(['estado' => 'inactivo']);

        return Redirect::route('salas.index')
            ->with('success', 'Sala eliminada exitosamente');
    }
}
