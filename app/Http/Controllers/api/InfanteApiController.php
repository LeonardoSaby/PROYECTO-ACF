<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Infante;
use Illuminate\Support\Facades\Validator ;


class InfanteApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Infante::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_infante' => 'required|string|max:255',
            'apellido_infante' => 'required|string|max:255',
            'CI_infante' => 'required|integer|unique:infantes,CI_infante',
            'fecha_nacimiento_infante' => 'required|date',
            'genero_infante' => 'required|string',
            'estado' => 'in:activo,inactivo',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // 2. Creación del infante
        $infante = Infante::create($request->all());

        // 3. Respuesta a Flutter
        return response()->json([
            'message' => 'Infante creado exitosamente.',
            'data' => $infante
        ], 201); // Código 201: Creado
    }

    /**
     * Display the specified resource.
     */
    public function show(Infante $infante)
    {
        return response()->json($infante, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Infante $infante)
    {
        // Validación, importante: ignorar el CI_infante actual del registro para la unicidad
        $validator = Validator::make($request->all(), [
            'CI_infante' => 'required|integer|unique:infantes,CI_infante,' . $infante->id, 
            'nombre_infante' => 'required|string|max:255',
            'apellido_infante' => 'required|string|max:255',
            'fecha_nacimiento_infante' => 'required|date',
            'genero_infante' => 'required|string',
            'estado' => 'in:activo,inactivo',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        
        // Actualiza el registro
        $infante->update($request->all());

        return response()->json([
            'message' => 'Infante actualizado exitosamente.',
            'data' => $infante
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Infante $infante)
    {
        $infante->update(['estado' => 'inactivo']);
        return response()->json(['message' => 'Infante eliminado exitosamente.'], 200);
    }
}
