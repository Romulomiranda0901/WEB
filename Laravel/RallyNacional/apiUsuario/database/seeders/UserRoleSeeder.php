<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Creamos los roles
        $admin = Role::create(['name' => 'admin']);
        $comite = Role::create(['name' => 'comite']);
        $coordinador_sede = Role::create(['name' => 'coordinador_sede']);
        $equipo =  Role::create(['name' => 'equipo']);



        //Creamos Permisos
        Permission::create(['name' => 'Todos']);
        Permission::create(['name' => 'Listar']);
        Permission::create(['name' => 'Crear']);
        Permission::create(['name' => 'Editar']);
        Permission::create(['name' => 'Eliminar']);
        Permission::create(['name' => 'Sedes_inscribir']);

        // Asignamos PermisoS
        $admin->givePermissionTo('Todos');
        $coordinador_sede->givePermissionTo('Listar');
        $coordinador_sede->givePermissionTo('Sedes_inscribir');
    }
}
