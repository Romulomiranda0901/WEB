<?php

namespace Database\Seeders;

use App\Models\Genero;
use Illuminate\Database\Seeder;

class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $generos = [
            [
                "nombre" => "Masculino", 
                "abreviacion" => "M"
            ],
            [
                "nombre" => "Femenino", 
                "abreviacion" => "F"
            ]
        ];

        foreach($generos as $genero){
            (new Genero(
                $genero
            ))->save();
        }

    }
}
