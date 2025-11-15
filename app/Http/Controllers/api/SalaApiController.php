<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Sala::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nombre_sala' => 'required|string|max:255',
            'capacidad_maxima' => 'required|integer',
            'estado' => 'required|in:activo,inactivo',
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }
        $sala = Sala::create($request->all());
        return response()->json($sala, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sala $sala)
    {
        return response()->json($sala, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sala $sala)
    {
        $validate = Validator::make($request->all(), [
            'nombre_sala' => 'sometimes|required|string|max:255',
            'capacidad_maxima' => 'sometimes|required|integer',
            'estado' => 'sometimes|required|in:activo,inactivo',
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }
        $sala->update($request->all());
        return response()->json($sala, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sala $sala)
    {
        $sala->update(['estado' => 'inactivo']);
        return response()->json(null, 204);
    }
}
