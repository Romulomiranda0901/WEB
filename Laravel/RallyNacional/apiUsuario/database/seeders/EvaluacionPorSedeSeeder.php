<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EvaluacionPorSedeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('evaluacion_por_sedes')->insert([
            [
                "entregables_id" => 1,
                "nota_documento" => 80.1,
                "nota_video" => 95,
                "nota_final" => 87.55,
                "descripcion" => 'Buen Trabajo'


            ]
        ]);
    }
}



