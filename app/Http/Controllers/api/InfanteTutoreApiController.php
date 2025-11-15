<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Infantestutore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InfanteTutoreApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Infantestutore::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'infante_id' => 'required|exists:infantes,id',
            'tutore_id' => 'required|exists:tutores,id',
            'parentezco' => 'nullable|string|max:255',
            'estado' => 'required|in:activo,inactivo',
        ]);
        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()], 400);
        }
        $infantes_tutore = Infantestutore::create($request->all());
        return response()->json($infantes_tutore, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Infantestutore $infantes_tutore)
    {
        return response()->json($infantes_tutore, 200);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Infantestutore $infantes_tutore)
    {
        $validate = Validator::make($request->all(), [
            'infante_id' => 'required|exists:infantes,id',
            'tutore_id' => 'required|exists:tutores,id',
            'parentezco' => 'nullable|string|max:255',
            'estado' => 'required|in:activo,inactivo',
        ]);
        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()], 400);
        }
        $infantes_tutore->update($request->all());
        return response()->json($infantes_tutore, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Infantestutore $infantes_tutore)
    {
        $infantes_tutore->update(['estado' => 'inactivo']);
        return response()->json(null, 204);
    }
}
