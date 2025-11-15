<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TurnoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $turnos = Turno::where('estado', 'activo')->paginate();
        return view('turno.index', compact('turnos'))
            ->with('i', ($request->input('page', 1) - 1) * $turnos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $turno = new Turno();

        return view('turno.create', compact('turno'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TurnoRequest $request): RedirectResponse
    {
        Turno::create($request->validated());

        return Redirect::route('turnos.index')
            ->with('success', 'Turno created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($turno_id): View
    {
        $turno = Turno::find($turno_id);

        return view('turno.show', compact('turno'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($turno_id): View
    {
        $turno = Turno::find($turno_id);

        return view('turno.edit', compact('turno'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TurnoRequest $request, Turno $turno): RedirectResponse
    {
        $turno->update($request->validated());

        return Redirect::route('turnos.index')
            ->with('success', 'Turno updated successfully');
    }

    public function destroy($turno_id): RedirectResponse
    {
        Turno::find($turno_id)->update(['estado' => 'inactivo']);

        return Redirect::route('turnos.index')
            ->with('success', 'Turno deleted successfully');
    }
}
