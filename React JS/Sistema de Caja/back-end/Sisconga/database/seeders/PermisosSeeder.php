<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("configuracion.permisos")->insert([
            [
                "id_rol" => 1,
                "id_menu"=>1,
                "id_permis"=>1,
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "id_rol" => 1,
                "id_menu"=>6,
                "id_permis"=>1,
                "created_at"=> date("Y-m-d H:i:s")
            ]


        ]);

        DB::table("configuracion.permisos")->insert([
            [
                "id_rol" => 1,
                "id_submenu"=>12,
                "id_permis"=>1,
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "id_rol" => 1,
                "id_submenu"=>13,
                "id_permis"=>1,
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "id_rol" => 1,
                "id_submenu"=>14,
                "id_permis"=>1,
                "created_at"=> date("Y-m-d H:i:s")
            ]
            ,
            [
                "id_rol" => 1,
                "id_submenu"=>15,
                "id_permis"=>1,
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "id_rol" => 1,
                "id_submenu"=>16,
                "id_permis"=>1,
                "created_at"=> date("Y-m-d H:i:s")
            ],

            [
                "id_rol" => 1,
                "id_submenu"=>12,
                "id_permis"=>2,
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "id_rol" => 1,
                "id_submenu"=>13,
                "id_permis"=>1,
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "id_rol" => 1,
                "id_submenu"=>14,
                "id_permis"=>2,
                "created_at"=> date("Y-m-d H:i:s")
            ]
            ,
            [
                "id_rol" => 1,
                "id_submenu"=>15,
                "id_permis"=>2,
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "id_rol" => 1,
                "id_submenu"=>16,
                "id_permis"=>2,
                "created_at"=> date("Y-m-d H:i:s")
            ],

            [
                "id_rol" => 1,
                "id_submenu"=>12,
                "id_permis"=>3,
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "id_rol" => 1,
                "id_submenu"=>13,
                "id_permis"=>3,
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "id_rol" => 1,
                "id_submenu"=>14,
                "id_permis"=>3,
                "created_at"=> date("Y-m-d H:i:s")
            ]
            ,
            [
                "id_rol" => 1,
                "id_submenu"=>15,
                "id_permis"=>3,
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "id_rol" => 1,
                "id_submenu"=>16,
                "id_permis"=>3,
                "created_at"=> date("Y-m-d H:i:s")
            ],

            [
                "id_rol" => 1,
                "id_submenu"=>12,
                "id_permis"=>4,
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "id_rol" => 1,
                "id_submenu"=>13,
                "id_permis"=>4,
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "id_rol" => 1,
                "id_submenu"=>14,
                "id_permis"=>4,
                "created_at"=> date("Y-m-d H:i:s")
            ]
            ,
            [
                "id_rol" => 1,
                "id_submenu"=>15,
                "id_permis"=>4,
                "created_at"=> date("Y-m-d H:i:s")
            ],
            [
                "id_rol" => 1,
                "id_submenu"=>16,
                "id_permis"=>4,
                "created_at"=> date("Y-m-d H:i:s")
            ]]);
    }
}
