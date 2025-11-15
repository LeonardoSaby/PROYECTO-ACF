<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asistencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AsistenciaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Asistencia::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'fecha' => 'required|string|max:255',
            'estado' => 'required|in:activo,inactivo',
        ]);
        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()], 400);
    }

        $asistencia = Asistencia::create($request->all());
        return response()->json($asistencia, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(ASistencia::all(), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'fecha' => 'required|string|max:255',
            'estado' => 'required|in:activo,inactivo',
        ]);
        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()], 400);
    }

        $asistencia = Asistencia::create($request->all());
        return response()->json($asistencia, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asistencia $asistencia)
    {
        $asistencia->update(['estado' => 'inactivo']);
        return response()->json(null, 204);
    }
}
