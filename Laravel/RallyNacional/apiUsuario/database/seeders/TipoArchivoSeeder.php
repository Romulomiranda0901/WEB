<?php

namespace Database\Seeders;

use App\Models\TipoArchivo;
use Illuminate\Database\Seeder;

class TipoArchivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoArchivo::create([
            "nombre" => "PDF",
            "terminacion" => "pdf"
        ]);
    }
}
