<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configuracion.menus')->insert([
            [
                "nombre" => "Inicio",
                "icono" =>  "fa-home",
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "nombre" => "Planificacion",
                "icono" =>  "fa-tasks",
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "nombre" => "Presupuesto",
                "icono" =>  "fa-book",
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "nombre" => "RRHH",
                "icono" =>  "fa-users",
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "nombre" => "Compras",
                "icono" =>  "fa-money",
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "nombre" => "Tesoreria",
                "icono" =>  "fa-solid fa-store",
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "nombre" => "Bodega",
                "icono" =>  "fa-cash-register",
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "nombre" => "Contabilidad",
                "icono" =>  "fa-balance-scale",
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "nombre" => "Reportes",
                "icono" =>  "fa-file",
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "nombre" => "Configuraciones",
                "icono" =>  "fa-cog",
                "created_at"=> date("Y-m-d H:i:s")
            ]

         ]);
    }
}
