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
        // PERMISOS según menú
        // -----------------------------------
        $permissions = [
            'acceso_y_seguridad' => [
                'access.users', 
                'access.roles'
            ],
            'parametrizacion' => [
                'access.tutores', 
                'access.infantes', 
                'access.salas', 
                'access.niveles',
                'access.cursos',
                'access.docentes',
                'access.turnos'
            ],
            'transacciones' => [
                'access.inscripciones',
                'access.asistencias',
                'access.asistencias.generar'
            ],
            'reportes' => [
                'access.reportes.lista_general',
                'access.reportes.lista_filtrada',
                'access.reportes.asistencias'
            ],
            'tutor' => ['access.tutor_view'],
        ];

        // Crear permisos
        foreach ($permissions as $group) {
            foreach ($group as $perm) {
                Permission::firstOrCreate([
                    'name' => $perm,
                    'guard_name' => $guard
                ]);
            }
        }

        // -----------------------------------
        // ROLES Y SUS PERMISOS
        // -----------------------------------
        $rolesPermissions = [
            'Administrador' => Permission::all()->pluck('name')->toArray(),
            'Docente' => [
                'access.inscripciones',
                'access.asistencias',
                'access.asistencias.generar',
                'access.reportes.lista_filtrada',
                'access.reportes.asistencias',
            ],
            'Tutor' => ['access.tutor_view'],
        ];

        foreach ($rolesPermissions as $roleName => $perms) {
            $role = Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => $guard
            ]);
            $role->syncPermissions($perms);
        }
    }
}
