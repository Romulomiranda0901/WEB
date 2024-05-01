<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntregableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entregables')->insert([
            [
                "desafio_id" => 1,
                "tipo_archivo_id" => 1,
                'criterio_id' => 1,
                "nombre" => "Archivo #1",
                "descripcion" => "archivo pdf",
                "link" => "https://youtu.be/MHu8TfCY1cE",
                "equipo_id"=>1
            ]
        ]);
    }
}
