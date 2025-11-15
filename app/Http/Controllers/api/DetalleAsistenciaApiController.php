<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\DetalleAsistencia;

class DetalleAsistenciaApiController extends Controller
{
    public function index()
    {
        return response()->json(DetalleAsistencia::all(), 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'inscripcion_id' => 'required|exists:inscripciones,id',
            'asistencia_id' => 'required|exists:asistencias,id',
            'observacion' => 'required|in:presente,ausente,licencia',
            'estado' => 'required|in:activo,inactivo',
        ]);

        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()], 400);
        }

        $detalle_asistencia = DetalleAsistencia::create($request->all());

        return response()->json($detalle_asistencia, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(DetalleAsistencia::all(), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetalleAsistencia $detalle_asistencia)
    {
        $validate = Validator::make($request->all(), [
            'inscripcion_id' => 'required|exists:inscripciones,id',
            'asistencia_id' => 'required|exists:asistencias,id',
            'observacion' => 'required|in:presente,ausente,licencia',
            'estado' => 'required|in:activo,inactivo',
        ]);

        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()], 400);
        }

        $detalle_asistencia = DetalleAsistencia::create($request->all());

        return response()->json($detalle_asistencia, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetalleAsistencia $detalle_asistencia)
    {
        $detalle_asistencia->update(['estado' => 'inactivo']);
                return response()->json(['message'=> 'Registro eliminado correctamente'], 200);

    }
}
