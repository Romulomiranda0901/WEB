<?php

namespace Database\Seeders;

use App\Models\grupo_etnico;
use Illuminate\Database\Seeder;

class GrupoEtnicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grupo_etnicos = [
            [
                "nombre" => "Otros"

            ],
            [
                "nombre" => "Miskitu"

            ], [
                "nombre" => "Ramas"

            ],
            [
                "nombre" => "Alto wangki-Bocay"

            ], [
                "nombre" => "Chorotega de Occidente"

            ],
            [
                "nombre" => "Chorotega del Centro"

            ], [
                "nombre" => "Chorotega del Norte"

            ],
            [
                "nombre" => "Chorotegas"

            ], [
                "nombre" => "Chorotegas del Pacífico"

            ],
            [
                "nombre" => "Creole"

            ], [
                "nombre" => "Garífunas"

            ],
            [
                "nombre" => "Kipla Sait Tasbaika"

            ],
            [
                "nombre" => "Matagalpa"

            ],
            [
                "nombre" => "Mayangna Sauni Bu"

            ],
            [
                "nombre" => "Miskitu Indian Tasbaika Kum"

            ],
            [
                "nombre" => "Nahoas"

            ],
            [
                "nombre" => "Nahualt"

            ],
            [
                "nombre" => "Sumu-Mayangna"

            ],
            [
                "nombre" => "Sutiaba"

            ],
            [
                "nombre" => "Ulwas"

            ],
            [
                "nombre" => "Ulwas Miskitu"

            ],
            [
                "nombre" => "Xiu Sutiaba"

            ]
        ];

        foreach($grupo_etnicos as $grupo_etnico){
            (new grupo_etnico(
                $grupo_etnico
            ))->save();
        }
    }
}
