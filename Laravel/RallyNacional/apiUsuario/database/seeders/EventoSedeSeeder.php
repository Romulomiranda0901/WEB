<?php

namespace Database\Seeders;

use App\Models\EventoSede;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class EventoSedeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/Participar_sede.json");
        $data = json_decode($json);

        foreach ($data as $obj) {
          EventoSede ::create([
            'sede_id' => $obj->sede_id,
            'coordinador_id' => $obj->coordinador_id,
            'max_participacion' => $obj->max_participacion,
            'evento_id' => 1,
              'anyo'=>$obj->anyo,
          ]);
        }


    }
}
