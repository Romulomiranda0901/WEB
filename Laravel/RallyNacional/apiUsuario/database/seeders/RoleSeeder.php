<?php

namespace Database\Seeders;

use App\Models\CoordinadorSede;
use App\Models\Equipo;
use App\Models\Patrocinador;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            [
                "nombre" => "Administrador",
                "clase" => null,
            ],
            [
                "nombre" => "Coordinador",
                "clase" => CoordinadorSede::class
            ],
            [
                "nombre" => "Equipo",
                "clase" => Equipo::class
            ],
            [
                "nombre" => "Patrocinador",
                "clase" => Patrocinador::class
            ]
        ];

        foreach ($role as $rol) {
            (new Role($rol))->save();
        }
    }
}
