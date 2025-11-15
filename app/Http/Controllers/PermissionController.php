<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Mostrar listado de permisos
     */
    public function index()
    {
        $permisos = Permission::with('roles')->paginate(10);
        return view('permisos.index', compact('permisos'));
    }

    /**
     * Mostrar formulario para crear un permiso
     */
    public function create()
    {
        return view('permisos.create');
    }

    /**
     * Guardar nuevo permiso
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return redirect()->route('permisos.index')
            ->with('success', 'Permiso creado correctamente.');
    }

    /**
     * Mostrar formulario para editar un permiso
     */
    public function edit($id)
    {
        $permiso = Permission::findOrFail($id);

        // ✅ Aquí cargamos los roles para los checkboxes
        $roles = Role::all();
        $rolesAsignados = $permiso->roles->pluck('id')->toArray();

        return view('permisos.edit', compact('permiso', 'roles', 'rolesAsignados'));
    }

    /**
     * Actualizar permiso y su asignación a roles
     */
    public function update(Request $request, $id)
    {
        $permiso = Permission::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permiso->id,
        ]);

        $permiso->update([
            'name' => $request->name,
        ]);

        // ✅ Actualizamos los roles asignados
        $rolesSeleccionados = $request->input('roles', []);
        $roles = Role::all();

        foreach ($roles as $rol) {
            if (in_array($rol->id, $rolesSeleccionados)) {
                $rol->givePermissionTo($permiso);
            } else {
                $rol->revokePermissionTo($permiso);
            }
        }

        return redirect()->route('permisos.index')
            ->with('success', 'Permiso actualizado correctamente.');
    }

    /**
     * Eliminar permiso
     */
    public function destroy($id)
    {
        Permission::findOrFail($id)->delete();

        return redirect()->route('permisos.index')
            ->with('success', 'Permiso eliminado correctamente.');
    }
}