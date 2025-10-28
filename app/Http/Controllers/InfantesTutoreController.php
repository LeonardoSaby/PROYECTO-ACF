<?php

namespace App\Http\Controllers;

use App\Models\InfantesTutore;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\InfantesTutoreRequest;
use Illuminate\Support\Facades\Redirect;
use App\Models\Infante as Infante;
use App\Models\Tutore;
use Illuminate\View\View;

class InfantesTutoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $infantesTutores = InfantesTutore::paginate();

        return view('infantes-tutore.index', compact('infantesTutores'))
            ->with('i', ($request->input('page', 1) - 1) * $infantesTutores->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
{
    $infantesTutore = new InfantesTutore();
    $infantes = Infante::all();
    $tutores = Tutore::all();

    return view('infantes-tutore.create', compact('infantesTutore', 'infantes', 'tutores'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(InfantesTutoreRequest $request): RedirectResponse
    {
        InfantesTutore::create($request->validated());

        return Redirect::route('infantes-tutores.index')
            ->with('success', 'InfantesTutore created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $infantesTutore = InfantesTutore::find($id);

        return view('infantes-tutore.show', compact('infantesTutore'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
{
    $infantesTutore = InfantesTutore::find($id);
    $infantes = Infante::all();
    $tutores = Tutore::all();

    return view('infantes-tutore.edit', compact('infantesTutore', 'infantes', 'tutores'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(InfantesTutoreRequest $request, InfantesTutore $infantesTutore): RedirectResponse
    {
        $infantesTutore->update($request->validated());

        return Redirect::route('infantes-tutores.index')
            ->with('success', 'InfantesTutore updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        InfantesTutore::find($id)->delete();

        return Redirect::route('infantes-tutores.index')
            ->with('success', 'InfantesTutore deleted successfully');
    }
}
