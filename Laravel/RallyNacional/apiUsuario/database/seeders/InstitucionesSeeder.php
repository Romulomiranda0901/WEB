<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitucionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('instituciones')->insert([
            [
                'nombre' => 'Universidad Nacional Autónoma de Nicaragua Leon',
                'abreviacion' => 'UNAN - León'
            ],
            [
                'nombre' => 'Universidad Nacional de Ingeniería',
                'abreviacion' => 'UNI'
            ]
        ]);
    }
}
