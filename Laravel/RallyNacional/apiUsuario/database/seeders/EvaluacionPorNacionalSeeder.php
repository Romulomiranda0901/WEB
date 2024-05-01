<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EvaluacionPorNacionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('evaluacion_por_nacionals')->insert([
            [
                "entregables_id" => 1,
                "nota_documento" => 80.1,
                "nota_video" => 80.1,
                "nota_final" => 80.1,
                "descripcion" => 'Buen Trabajo'

            ]
        ]);
    }
}
