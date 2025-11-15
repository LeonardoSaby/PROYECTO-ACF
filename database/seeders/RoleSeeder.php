<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $guard = 'web';

        // -----------------------------------
        // PERMISOS (agrupados por área)
        // -----------------------------------
        $permissions = [
            'usuarios' => ['users.manage', 'roles.manage'],
            'parametros' => [
                'infantes.manage', 'tutores.manage', 'turnos.manage', 
                'niveles.manage', 'salas.manage', 'docentes.manage', 
                'cursos.manage', 'infantes_tutores.manage', 'inscripciones.manage',
                'detalle_asistencias.manage'
            ],
            'asistencias' => ['asistencias.manage', 'asistencias.generar'],
            'reportes' => [
                'reportes.lista_general', 'reportes.lista_filtrada', 
                'reportes.asistencia', 'reportes.asistencias'
            ],
            'tutor' => ['tutor.view'],
        ];

        // Crear permisos
        foreach($permissions as $group){
            foreach($group as $perm){
                Permission::firstOrCreate(['name' => $perm, 'guard_name' => $guard]);
            }
        }

        // -----------------------------------
        // ROLES Y SUS PERMISOS
        // -----------------------------------
        $rolesPermissions = [
            'Administrador' => Permission::all()->pluck('name')->toArray(),
            'Docente' => [
                'inscripciones.manage', 
                'asistencias.manage',
                'asistencias.generar',
                'reportes.lista_filtrada',
                'reportes.asistencia',
            ],
            'Tutor' => ['tutor.view'],
        ];

        foreach($rolesPermissions as $roleName => $perms){
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => $guard]);
            $role->syncPermissions($perms);
        }
    }
}
