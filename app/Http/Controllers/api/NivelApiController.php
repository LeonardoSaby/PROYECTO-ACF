<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Nivele;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NivelApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Nivele::all(), 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nombre_nivel' => 'required|string|max:255',
            'edad_minima' => 'required|integer|min:0',
            'edad_maxima' => 'required|integer|min:0',
            'estado' => 'required|in:activo,inactivo',
        ]);
        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()], 400);
        }
        $nivele = Nivele::create($request->all());
        return response()->json($nivele, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Nivele $nivele)
    {
        return response()->json($nivele, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nivele $nivele)
    {
        $validate = Validator::make($request->all(), [
            'nombre_nivel' => 'sometimes|required|string|max:255',
            'edad_minima' => 'sometimes|required|integer|min:0',
            'edad_maxima' => 'sometimes|required|integer|min:0',
            'estado' => 'sometimes|required|in:activo,inactivo',
        ]);
        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()], 400);
        }
        $nivele->update($request->all());
        return response()->json($nivele, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nivele $nivele)
    {
        $nivele->update(['estado' => 'inactivo']);
        return response()->json(null, 204);
    }
}
