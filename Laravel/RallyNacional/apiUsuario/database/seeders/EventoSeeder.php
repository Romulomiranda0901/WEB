<?php

namespace Database\Seeders;

use App\Models\Evento;
use Illuminate\Database\Seeder;

class EventoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Evento::create([
            "nombre" => "Rally 2022",
            "fecha_inicia" => date("Y-m-d"),
            "fecha_finaliza" => date('Y-m-d', strtotime("+1 month")),
            "anyo" => date("Y")
        ]);
    }
}
