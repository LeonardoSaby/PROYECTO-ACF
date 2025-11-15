<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocenteApiController extends Controller
{
    /**
     * Listado de docentes.
     */
    public function index()
    {
        return response()->json(Docente::all(), 200);
    }

    /**
     * Crear un nuevo docente.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nombre_docente' => 'required|string|max:255',
            'apellido_docente' => 'required|string|max:255',
            'telefono_docente' => 'nullable|string|max:20',
            'CI_docente' => 'required|integer|unique:docentes,CI_docente',
            'correo_electronico_docente' => 'required|email|unique:docentes,correo_electronico_docente',
            'direccion_docente' => 'nullable|string|max:255',
            'fecha_contratacion' => 'nullable|date',
            'estado' => 'in:activo,inactivo',
            'curso_id' => 'required|integer|exists:cursos,curso_id'
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        Docente::create($validate->validated());

        return response()->json(['message' => 'Docente creado correctamente'], 201);
    }

    /**
     * Mostrar un docente específico.
     */
    public function show(Docente $docente)
    {
        return response()->json($docente, 200);
    }

    /**
     * Actualizar un docente existente.
     */
    public function update(Request $request, Docente $docente)
    {
        $validate = Validator::make($request->all(), [
            'nombre_docente' => 'sometimes|required|string|max:255',
            'apellido_docente' => 'sometimes|required|string|max:255',
            'telefono_docente' => 'nullable|string|max:20',
            'CI_docente' => 'sometimes|required|integer|unique:docentes,CI_docente,' . $docente->id,
            'correo_electronico_docente' => 'sometimes|required|email|unique:docentes,correo_electronico_docente,' . $docente->id,
            'direccion_docente' => 'nullable|string|max:255',
            'fecha_contratacion' => 'nullable|date',
            'estado' => 'in:activo,inactivo',
            'curso_id' => 'sometimes|required|integer|exists:cursos,curso_id'
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $docente->update($validate->validated());

        return response()->json(['message' => 'Docente actualizado correctamente'], 200);
    }

    /**
     * Desactivar un docente (soft delete).
     */
    public function destroy(Docente $docente)
    {
        $docente->update(['estado' => 'inactivo']);
        return response()->json(['message' => 'Docente desactivado correctamente'], 200);
    }
}
