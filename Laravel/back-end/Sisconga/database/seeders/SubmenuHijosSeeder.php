<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubmenuHijosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configuracion.submenu_hijos')->insert([
            [
                "nombre" => "Alta del personal",
                "icono" =>  "fa-users",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_submenu"=> 8
            ],
            [
                "nombre" => "Baja del personal",
                "icono" =>  "fa-users",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_submenu"=> 8
            ],
            [
                "nombre" => "Promociones o demociones",
                "icono" =>  "fa-users",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_submenu"=> 8
            ],
            [
                "nombre" => "Horas Extras",
                "icono" =>  "fa-users",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_submenu"=> 9
            ],
            [
                "nombre" => "Aumento de Salarios",
                "icono" =>  "fa-users",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_submenu"=> 9
            ],
            [
                "nombre" => " Devengado o Deduciones",
                "icono" =>  "fa-users",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_submenu"=> 9
            ],
            [
                "nombre" => "Liquidacion",
                "icono" =>  "fa-users",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_submenu"=> 9
            ],
            [
                "nombre" => "Planilla",
                "icono" =>  "fa-users",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_submenu"=> 9
            ],
        ]);
    }
}
