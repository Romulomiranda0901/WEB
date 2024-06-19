<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("configuracion.rols")->insert([
            [
                "nombre" => "Admin",
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "nombre" => "Tesoreria",
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "nombre" => "Planificacion",
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "nombre" => "Presupuesto",
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "nombre" => "RRHH",
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "nombre" => "contabilidad ",
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "nombre" => "Compras",
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "nombre" => "Bodega",
                "created_at"=> date("Y-m-d H:i:s")
            ],

        ]);
    }
}
