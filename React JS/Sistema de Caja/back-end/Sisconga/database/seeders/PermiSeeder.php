<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("configuracion.permis")->insert([
            [
                "nombre" => "Visualizar",
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "nombre" => "Crear",
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "nombre" => "Modificar",
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "nombre" => "Eliminar",
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "nombre" => "Exel",
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "nombre" => "PDF",
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "nombre" => "Subir Archivos",
                "created_at"=> date("Y-m-d H:i:s")
            ]
        ]);
    }
}
