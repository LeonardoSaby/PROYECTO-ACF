<?php

namespace App\Http\Controllers;

use App\Models\Nivele;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\NiveleRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class NiveleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $niveles = Nivele::paginate();

        return view('nivele.index', compact('niveles'))
            ->with('i', ($request->input('page', 1) - 1) * $niveles->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $nivele = new Nivele();

        return view('nivele.create', compact('nivele'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NiveleRequest $request): RedirectResponse
    {
        Nivele::create($request->validated());

        return Redirect::route('niveles.index')
            ->with('success', 'Nivele created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $nivele = Nivele::find($id);

        return view('nivele.show', compact('nivele'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $nivele = Nivele::find($id);

        return view('nivele.edit', compact('nivele'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NiveleRequest $request, Nivele $nivele): RedirectResponse
    {
        $nivele->update($request->validated());

        return Redirect::route('niveles.index')
            ->with('success', 'Nivele updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Nivele::find($id)->delete();

        return Redirect::route('niveles.index')
            ->with('success', 'Nivele deleted successfully');
    }
}
