<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SedeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('sedes')->insert([
            [
                "nombre" => "Facultad De Ciencia Tecnologia",
                "institucion_id" => 1,
                "municipio_id" => 30
            ],
            [
                "nombre" => "Facultad De Medicina",
                "institucion_id" => 1,
                "municipio_id" => 30
            ]
        ]);
    }
}
