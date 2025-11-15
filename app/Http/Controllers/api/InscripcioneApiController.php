<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Inscripcione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InscripcioneApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $inscripciones = Inscripcione::with(['infante', 'curso', 'turno'])->get();
    return response()->json($inscripciones);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'infante_id' => 'required|exists:infantes,id',
            'turno_id' => 'required|exists:turnos,id',
            'curso_id' => 'required|exists:cursos,id',
            'fecha_inscripcion' => 'required|date',
            'estado' => 'in:activo,inactivo'
        ]);
        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()], 400);
        }
        $inscripcione = Inscripcione::create($request->all());
        return response()->json($inscripcione, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inscripcione $inscripcione)
    {
        return response()->json($inscripcione, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inscripcione $inscripcione)
    {
        $validate = Validator::make($request->all(), [
            'infante_id' => 'exists:infantes,id',
            'turno_id' => 'exists:turnos,id',
            'curso_id' => 'exists:cursos,id',
            'fecha_inscripcion' => 'date',
            'estado' => 'in:activo,inactivo'
        ]);
        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()], 400);
        }
        $inscripcione->update($request->all());
        return response()->json($inscripcione, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inscripcione $inscripcione)
    {
        $inscripcione->delete();
        return response()->json(null, 204);
    }
}
