<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Spatie\Permission\Models\Role;

class ModelHasRoleController extends Controller
{
    /**
     * Mostrar listado de usuarios con sus roles.
     */
    public function index(Request $request)
    {
        $users = User::with('roles')->paginate(10);

        return view('model-has-role.index', compact('users'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Formulario para asignar roles a usuarios.
     */
    public function create()
    {
        $users = User::all();
        $roles = Role::all();

        return view('model-has-role.create', compact('users', 'roles'));
    }

    /**
     * Guardar roles asignados a usuarios.
     */
    public function store(Request $request)
    {
        $request->validate([
            'users' => 'required|array',
            'users.*' => 'exists:users,id',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $users = User::whereIn('id', $request->users)->get();
        $roles = Role::whereIn('id', $request->roles)->get(); // Convertir IDs a modelos

        foreach ($users as $user) {
            $user->syncRoles($roles); // Asigna los roles correctamente
        }

        return redirect()->route('model-has-roles.index')
            ->with('success', 'Roles asignados correctamente.');
    }

    /**
     * Formulario para editar roles de un usuario.
     */
    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        $roles = Role::all();

        return view('model-has-role.edit', compact('user', 'roles'));
    }

    /**
     * Actualizar roles de un usuario.
     */
    public function update(Request $request, $user_id)
    {
        $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user = User::findOrFail($user_id);
        $roles = Role::whereIn('id', $request->roles)->get(); // Convertir IDs a modelos

        $user->syncRoles($roles);

        return redirect()->route('model-has-roles.index')
            ->with('success', 'Roles actualizados correctamente.');
    }

    /**
     * Eliminar un rol específico de un usuario.
     */
    public function destroy($user_id)
{
    $user = User::findOrFail($user_id);

    // Eliminar todos los roles asignados al usuario
    $user->syncRoles([]); // Esto quita todos los roles

    return redirect()->route('model-has-roles.index')
        ->with('success', 'Todos los roles del usuario fueron eliminados correctamente.');
}

}
