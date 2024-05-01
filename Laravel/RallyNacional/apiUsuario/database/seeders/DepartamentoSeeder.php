<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        // Pacifico
        DB::table('departamentos')->insert([


            [
                "nombre" => "CARAZO",
                "region_id" => 1,
            ],
            [


                "nombre" => "CHINANDEGA",
                "region_id" => 1

            ],



            [


                "nombre" => "GRANADA",
                "region_id" => 1
            ],

            [


                "nombre" => "LEON",
                "region_id" => 1

            ],

            [


                "nombre" => "MANAGUA",
                "region_id" => 1
            ],
            [


                "nombre" => "MASAYA",
                "region_id" => 1
            ],




            [


                "nombre" => "RIVAS",
                "region_id" => 1

            ]
        ]);

        //Central

        DB::table('departamentos')->insert([
            [


                "nombre" => "BOACO",
                "region_id" => 2

            ],


            [


                "nombre" => "CHONTALES",
                "region_id" => 2
            ],
            [

                "nombre" => "ESTELI",
                "region_id" => 2
            ],


            [

                "nombre" => "JINOTEGA",
                "region_id" => 2
            ],

            [

                "nombre" => "MADRIZ",
                "region_id" => 2

            ],


            [

                "nombre" => "MATAGALPA",
                "region_id" => 2

            ],
            [

                "nombre" => "NUEVA SEGOVIA",
                "region_id" => 2
            ],


            [

                "nombre" => "RIO SAN JUAN",
                "region_id" => 2
            ]
        ]);

        // Atlantico



        DB::table('departamentos')->insert([
            [

                "nombre" => "R.A.A.N.",
                "region_id" => 3
            ],
            [

                "nombre" => "R.A.A.S.",
                "region_id" => 3
            ]
        ]);


    }
}
