<?php

namespace Database\Seeders;

use App\Models\Usuarios;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("configuracion.usuarios")->insert([
            [
                "nombres" => "administrador",
                "apellidos" => "Sistema",
                "inss" => "1",
                "password" => bcrypt("123qwe"),
                "correo" => " ",
                "id_rol" => 1,
                "created_at"=> date("Y-m-d H:i:s")
            ]
        ]);
    }
}
