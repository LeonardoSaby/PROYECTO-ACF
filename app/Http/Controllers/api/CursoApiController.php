<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CursoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $cursos = Curso::with(['nivel', 'sala'])->get();
    return response()->json($cursos);
}



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nombre_curso' => 'unique:cursos|string|max:255',
            'nivel_id' => 'required|exists:niveles,id',
            'sala_id' => 'required|exists:salas,id',
            'estado' => 'required|in:activo,inactivo',
        ]);
        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()], 400);
    }

        $curso = Curso::create($request->all());
        return response()->json($curso, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso)
    {
        return response()->json($curso, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curso $curso)
    {
        $validate = Validator::make($request->all(), [
            'nombre_curso' => 'sometimes|unique:cursos|string|max:255',
            'nivel_id' => 'sometimes|required|exists:niveles,id',
            'sala_id' => 'sometimes|required|exists:salas,id',
            'estado' => 'sometimes|required|in:activo,inactivo',
        ]);
        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()], 400);
        }
        $curso->update($request->all());
        return response()->json($curso, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curso $curso)
    {
        $curso->update(['estado' => 'inactivo']);
        return response()->json(null, 204);
    }
}
