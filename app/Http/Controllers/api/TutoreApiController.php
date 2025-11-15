<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tutore;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TutoreApiController extends Controller
{
    /**
     * Listado de todos los tutores.
     */
    public function index()
    {
        $tutores = Tutore::all();
        return response()->json($tutores, 200);
    }

    /**
     * Mostrar un tutor específico.
     */
    public function show($tutor_id)
    {
        $tutor = Tutore::find($tutor_id);
        if (!$tutor) {
            return response()->json(['message' => 'Tutor no encontrado'], 404);
        }
        return response()->json($tutor, 200);
    }

    /**
     * Crear un nuevo tutor y su usuario asociado.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_tutor' => 'required|string|max:255',
            'apellido_tutor' => 'required|string|max:255',
            'CI_tutor' => 'required|integer|unique:tutores,CI_tutor',
            'telefono_tutor' => 'required|string|max:20',
            'correo_electronico_tutor' => 'required|email|unique:users,email',
            'direccion_tutor' => 'required|string|max:255',
            'estado' => 'in:activo,inactivo',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Crear usuario
        $user = User::create([
            'name' => $request->nombre_tutor . ' ' . $request->apellido_tutor,
            'email' => $request->correo_electronico_tutor,
            'password' => bcrypt($request->password),
        ]);

        // Crear tutor asociado
        $tutor = Tutore::create([
            'nombre_tutor' => $request->nombre_tutor,
            'apellido_tutor' => $request->apellido_tutor,
            'CI_tutor' => $request->CI_tutor,
            'telefono_tutor' => $request->telefono_tutor,
            'correo_electronico_tutor' => $request->correo_electronico_tutor,
            'direccion_tutor' => $request->direccion_tutor,
            'estado' => $request->estado ?? 'activo',
            'user_id' => $user->id
        ]);

        return response()->json([
            'message' => 'Tutor creado correctamente',
            'user' => $user,
            'tutor' => $tutor
        ], 201);
    }

    /**
     * Actualizar tutor y usuario asociado.
     */
    public function update(Request $request, $tutor_id)
    {
        $tutor = Tutore::find($tutor_id);
        if (!$tutor) {
            return response()->json(['message' => 'Tutor no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre_tutor' => 'sometimes|required|string|max:255',
            'apellido_tutor' => 'sometimes|required|string|max:255',
            'CI_tutor' => 'sometimes|required|integer|unique:tutores,CI_tutor,' . $tutor->tutor_id,
            'telefono_tutor' => 'sometimes|required|string|max:20',
            'correo_electronico_tutor' => 'sometimes|required|email|unique:users,email,' . $tutor->user_id,
            'direccion_tutor' => 'sometimes|required|string|max:255',
            'estado' => 'in:activo,inactivo',
            'password' => 'nullable|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Actualizar usuario vinculado
        $user = User::find($tutor->user_id);
        if ($user) {
            if ($request->filled('correo_electronico_tutor')) {
                $user->email = $request->correo_electronico_tutor;
            }
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }
            if ($request->filled('nombre_tutor') || $request->filled('apellido_tutor')) {
                $user->name = trim(($request->nombre_tutor ?? $tutor->nombre_tutor) . ' ' . ($request->apellido_tutor ?? $tutor->apellido_tutor));
            }
            $user->save();
        }

        // Actualizar datos del tutor (sin contraseña)
        $tutor->update($request->except(['password']));

        return response()->json([
            'message' => 'Tutor actualizado correctamente',
            'tutor' => $tutor,
            'user' => $user
        ], 200);
    }

    /**
     * Eliminar (desactivar) tutor.
     */
    public function destroy(Tutore $tutor)
    {
        $tutor->update(['estado' => 'inactivo']);

        return response()->json(['message' => 'Tutor desactivado correctamente'], 200);
    }
}
