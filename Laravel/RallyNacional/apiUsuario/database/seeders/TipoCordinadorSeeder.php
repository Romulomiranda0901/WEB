<?php

namespace Database\Seeders;

use App\Models\tipo_cordinador;
use Illuminate\Database\Seeder;

class TipoCordinadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = [
            [
                "tipo" => "Coordinador"

            ],
            [
                "tipo" => "Tutor"

            ]
        ];

        foreach ($roles as $rol) {
            (new tipo_cordinador($rol))->save();
        }

        tipo_cordinador::create([
            "tipo" => "Coordinador"
        ],[
            "tipo" => "Tutor"
        ]);
    }
}
