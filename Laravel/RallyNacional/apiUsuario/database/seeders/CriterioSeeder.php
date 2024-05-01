<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CriterioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('criterios')->insert([
            [
                'nombre' => 'Categoria 1',
                'descripcion' => 'descripcion 1'

            ],
            [
                'nombre' => 'Categoria 2',
                'descripcion' => 'descripcion 2'

            ],
            [
                'nombre' => 'Categoria 3',
                'descripcion' => 'descripcion 3'

            ]


        ]);

    }
}
