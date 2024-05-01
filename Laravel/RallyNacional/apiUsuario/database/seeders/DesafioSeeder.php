<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesafioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('desafios')->insert([
            [
                "evento_id" => 1,
                "categoria_id" => 1,
                "patrocinadors_id"=>1,
                "nombre" => "Desafio #1",
                "descripcion" => "Este es el desafio #1",
                "puntaje" => 100,
            ]
        ]);
    }
}
