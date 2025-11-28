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
                'acceso.usuarios', 
                'acceso.roles',
                'acceso.Roles_y_usuarios', // <--- nuevo permiso
            ],
            'parametrizacion' => [
                'acceso.tutores', 
                'acceso.infantes', 
                'acceso.salas', 
                'acceso.niveles',
                'acceso.cursos',
                'acceso.docentes',
                'acceso.turnos'
            ],
            'transacciones' => [
                'acceso.inscripciones',
                'acceso.asistencias',
                'acceso.asistencias.generar'
            ],
            'reportes' => [
                'acceso.reportes.lista_general',
                'acceso.reportes.lista_filtrada',
                'acceso.reportes.asistencias',
                'acceso.reportes.comprobante', // <--- nuevo permiso para el reporte de comprobante
            ],
            'tutor' => ['acceso.tutor_view'],
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
                'acceso.inscripciones',
                'acceso.asistencias',
                'acceso.asistencias.generar',
                'acceso.reportes.lista_filtrada',
                'acceso.reportes.asistencias',
                'acceso.reportes.comprobante', // dar permiso de comprobante a docente también
            ],
            'Tutor' => ['acceso.tutor_view'],
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
