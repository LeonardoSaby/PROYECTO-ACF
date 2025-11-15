<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator ;

class TurnoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Turno::all(), 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_turno' => 'required|string|max:255',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'estado' => 'in:activo,inactivo', // Opcional: valida que el valor sea correcto
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // 2. Creación del turno
        $turno = Turno::create($request->all());
        // 3. Respuesta a Flutter
        return response()->json([
            'message' => 'Turno creado exitosamente.',
            'data' => $turno
        ], 201); // Código 201: Creado
    }

    /**
     * Display the specified resource.
     */
    public function show(Turno $turno)
    {
        return response()->json($turno, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Turno $turno)
    {
        $validator = Validator::make($request->all(), [
            'nombre_turno' => 'sometimes|required|string|max:255',
            'hora_inicio' => 'sometimes|required|date_format:H:i',
            'hora_fin' => 'sometimes|required|date_format:H:i|after:hora_inicio',
            'estado' => 'sometimes|in:activo,inactivo', // Opcional: valida que el valor sea correcto
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Actualización del turno
        $turno->update($request->all());

        return response()->json([
            'message' => 'Turno actualizado exitosamente.',
            'data' => $turno
        ], 200); // Código 200: OK

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Turno $turno)
    {
        $turno->update(['estado' => 'inactivo']);
        return response()->json([
            'message' => 'Turno eliminado exitosamente.'
        ], 200); // Código 200: OK
    }
}
