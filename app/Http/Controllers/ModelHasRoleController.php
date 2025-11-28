<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class ModelHasRoleController extends Controller
{
    /**
     * Mostrar listado de usuarios con roles asignados.
     */
    public function index(Request $request)
    {
        // Solo usuarios que tengan al menos un rol
        $users = User::whereHas('roles')->with('roles')->paginate(100);

        return view('model-has-role.index', compact('users'))
            ->with('i', ($request->input('page', 1) - 1) * 100);
    }

    /**
     * Formulario para asignar roles a usuarios.
     */
    public function create()
    {
        // Aquí traes todos los usuarios que aún no tengan rol asignado
        $users = User::doesntHave('roles')->get();
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
        $roles = Role::whereIn('id', $request->roles)->get();

        foreach ($users as $user) {
            $user->syncRoles($roles); // Asigna los roles
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
        $roles = Role::whereIn('id', $request->roles)->get();

        $user->syncRoles($roles);

        return redirect()->route('model-has-roles.index')
            ->with('success', 'Roles actualizados correctamente.');
    }

    /**
     * Eliminar roles de un usuario (solo de model_has_roles).
     */
    public function destroy($user_id)
    {
        $user = User::findOrFail($user_id);

        // Solo elimina los roles asignados, no el usuario
        $user->roles()->detach();

        return redirect()->route('model-has-roles.index')
            ->with('success', 'Roles eliminados del usuario correctamente.');
    }
}
