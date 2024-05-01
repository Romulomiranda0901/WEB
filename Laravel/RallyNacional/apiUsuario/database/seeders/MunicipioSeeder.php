<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Boaco

        DB::table('municipios')->insert([
            [
                "nombre" => "DIRIAMBA",
                "departamento_id" => 1
            ],
            [
                "nombre" => "DOLORES",
                "departamento_id" => 1
            ],
            [
                "nombre" => "EL ROSARIO",
                "departamento_id" => 1
            ],
            [
                "nombre" => "JINOTEPE",
                "departamento_id" => 1
            ],
            [
                "nombre" => "LA CONQUISTA",
                "departamento_id" => 1
            ],
            [
                "nombre" => "LA PAZ DE CARAZO",
                "departamento_id" => 1
            ],
            [
                "nombre" => "SAN MARCOS",
                "departamento_id" => 1
            ],
            [
                "nombre" => "SANTA TERESA",
                "departamento_id" => 1
            ]
        ]);

        //CHINANDEGA

        DB::table('municipios')->insert([
            [
                "nombre" => "CHICHIGALPA",
                "departamento_id" => 2
            ],
            [
                "nombre" => "CHINANDEGA",
                "departamento_id" => 2
            ],
            [
                "nombre" => "CINCO PINOS",
                "departamento_id" => 2
            ],
            [
                "nombre" => "CORINTO",
                "departamento_id" => 2
            ],
            [
                "nombre" => "EL REALEJO",
                "departamento_id" => 2
            ],
            [
                "nombre" => "EL VIEJO",
                "departamento_id" => 2
            ],
            [
                "nombre" => "POSOLTEGA",
                "departamento_id" => 2
            ],
            [
                "nombre" => "PUERTO MORAZAN",
                "departamento_id" => 2
            ],
            [
                "nombre" => "SAN FRANCISCO DEL NORTE",
                "departamento_id" => 2
            ],
            [
                "nombre" => "SAN PEDRO DEL NORTE",
                "departamento_id" => 2
            ],
            [
                "nombre" => "SANTO TOMAS DEL NORTE",
                "departamento_id" => 2
            ],
            [
                "nombre" => "SOMOTILLO",
                "departamento_id" => 2
            ],
            [
                "nombre" => "VILLANUEVA",
                "departamento_id" => 2
            ]
        ]);

        // Granada

        DB::table('municipios')->insert([
            [
                "nombre" => "DIRIA",
                "departamento_id" => 3
            ],
            [
                "nombre" => "DIRIOMO",
                "departamento_id" => 3
            ],
            [
                "nombre" => "GRANADA",
                "departamento_id" => 3
            ],
            [
                "nombre" => "NANDAIME",
                "departamento_id" => 3
            ]
        ]);

        //Leon


        DB::table('municipios')->insert([
            [
                "nombre" => "ACHUAPA",
                "departamento_id" => 4
            ],
            [
                "nombre" => "EL SAUCE",
                "departamento_id" => 4
            ],
            [
                "nombre" => "JICARAL",
                "departamento_id" => 4
            ],
            [
                "nombre" => "LA PAZ CENTRO",
                "departamento_id" => 4
            ],
            [
                "nombre" => "LEON",
                "departamento_id" => 4
            ],
            [
                "nombre" => "MALPAISILLO Y LARREYNAGA",
                "departamento_id" => 4
            ],
            [
                "nombre" => "NAGAROTE",
                "departamento_id" => 4
            ],
            [
                "nombre" => "QUEZALGUAQUE",
                "departamento_id" => 4
            ],
            [
                "nombre" => "SANTA ROSA DEL PEÑON",
                "departamento_id" => 4
            ],
            [
                "nombre" => "TELICA",
                "departamento_id" => 4
            ]
        ]);

        //Managua


        DB::table('municipios')->insert([
            [
                "nombre" => "CIUDAD SANDINO",
                "departamento_id" => 5
            ],
            [
                "nombre" => "EL CRUCERO",
                "departamento_id" => 5
            ],
            [
                "nombre" => "MANAGUA",
                "departamento_id" => 5
            ],
            [
                "nombre" => "MATEARE",
                "departamento_id" => 5
            ],
            [
                "nombre" => "SAN FRANCISCO LIBRE",
                "departamento_id" => 5
            ],
            [
                "nombre" => "SAN RAFAEL DEL SUR",
                "departamento_id" => 5
            ],
            [
                "nombre" => "TICUANTEPE",
                "departamento_id" => 5
            ],
            [
                "nombre" => "TIPITAPA",
                "departamento_id" => 5
            ],
            [
                "nombre" => "VILLA EL CARMEN",
                "departamento_id" => 5
            ]
        ]);

        //Masaya


        DB::table('municipios')->insert([
            [
                "nombre" => "CATARINA",
                "departamento_id" => 6
            ],
            [
                "nombre" => "LA CONCEPCION",
                "departamento_id" => 6
            ],
            [
                "nombre" => "MASATEPE",
                "departamento_id" => 6
            ],
            [
                "nombre" => "MASAYA",
                "departamento_id" => 6
            ],
            [
                "nombre" => "NANDASMO",
                "departamento_id" => 6
            ],
            [
                "nombre" => "NINDIRI",
                "departamento_id" => 6
            ],
            [
                "nombre" => "NIQUINOHOMO",
                "departamento_id" => 6
            ],
            [
                "nombre" => "SAN JUAN DE ORIENTE",
                "departamento_id" => 6
            ],
            [
                "nombre" => "TISMA",
                "departamento_id" => 6
            ]
        ]);

        // Rivas


        DB::table('municipios')->insert([
            [
                "nombre" => "ALTAGRACIA",
                "departamento_id" => 7
            ],
            [
                "nombre" => "BELEN",
                "departamento_id" => 7
            ],
            [
                "nombre" => "BUENOS AIRES",
                "departamento_id" => 7
            ],
            [
                "nombre" => "CARDENAS",
                "departamento_id" => 7
            ],
            [
                "nombre" => "MOYOGALPA",
                "departamento_id" => 7
            ],
            [
                "nombre" => "POTOSI",
                "departamento_id" => 7
            ],
            [
                "nombre" => "RIVAS",
                "departamento_id" => 7
            ],
            [
                "nombre" => "SAN JORGE",
                "departamento_id" => 7
            ],
            [
                "nombre" => "SAN JUAN DEL SUR",
                "departamento_id" => 7
            ],
            [
                "nombre" => "TOLA",
                "departamento_id" => 7
            ]
        ]);

        //Boaco


        DB::table('municipios')->insert([
            [
                "nombre" => "BOACO",
                "departamento_id" => 8
            ],
            [
                "nombre" => "CAMOAPA",
                "departamento_id" => 8
            ],
            [
                "nombre" => "SAN JOSE DE LOS REMATES",
                "departamento_id" => 8
            ],
            [
                "nombre" => "SAN LORENZO",
                "departamento_id" => 8
            ],
            [
                "nombre" => "SANTA LUCIA",
                "departamento_id" => 8
            ],
            [
                "nombre" => "TEUSTEPE",
                "departamento_id" => 8
            ]
        ]);

        //Chontales


        DB::table('municipios')->insert([
            [
                "nombre" => "ACOYAPA",
                "departamento_id" => 9
            ],
            [
                "nombre" => "COMALAPA",
                "departamento_id" => 9
            ],
            [
                "nombre" => "CUAPA",
                "departamento_id" => 9
            ],
            [
                "nombre" => "EL CORAL",
                "departamento_id" => 9
            ],
            [
                "nombre" => "JUIGALPA",
                "departamento_id" => 9
            ],
            [
                "nombre" => "LA LIBERTAD",
                "departamento_id" => 9
            ],
            [
                "nombre" => "SAN PEDRO DE LOVAGO",
                "departamento_id" => 9
            ],
            [
                "nombre" => "SANTO DOMINGO",
                "departamento_id" => 9
            ],
            [
                "nombre" => "SANTO TOMAS",
                "departamento_id" => 9
            ],
            [
                "nombre" => "VILLA SANDINO",
                "departamento_id" => 9
            ]
        ]);


        //Esteli


        DB::table('municipios')->insert([
            [
                "nombre" => "CONDEGA",
                "departamento_id" => 10
            ],
            [
                "nombre" => "ESTELI",
                "departamento_id" => 10
            ],
            [
                "nombre" => "LA TRINIDAD",
                "departamento_id" => 10
            ],
            [
                "nombre" => "PUEBLO NUEVO",
                "departamento_id" => 10
            ],
            [
                "nombre" => "SAN JUAN DE LIMAY",
                "departamento_id" => 10
            ],
            [
                "nombre" => "SAN NICOLAS",
                "departamento_id" => 10
            ]
        ]);

        //JINOTEGA


        DB::table('municipios')->insert([
            [
                "nombre" => "BOCAY",
                "departamento_id" => 11
            ],
            [
                "nombre" => "EL CUA",
                "departamento_id" => 11
            ],
            [
                "nombre" => "JINOTEGA",
                "departamento_id" => 11
            ],
            [
                "nombre" => "LA CONCORDIA",
                "departamento_id" => 11
            ],
            [
                "nombre" => "PANTASMA",
                "departamento_id" => 11
            ],
            [
                "nombre" => "SAN RAFAEL DEL NORTE",
                "departamento_id" => 11
            ],
            [
                "nombre" => "SAN SEBASTIAN DE YALI",
                "departamento_id" => 11
            ],
            [
                "nombre" => "WIWILI",
                "departamento_id" => 11
            ]
        ]);

        //Madriz


        DB::table('municipios')->insert([
            [
                "nombre" => "LAS SABANAS",
                "departamento_id" => 12
            ],
            [
                "nombre" => "PALACAGUINA",
                "departamento_id" => 12
            ],
            [
                "nombre" => "SAN JOSE DE CUSMAPA",
                "departamento_id" => 12
            ],
            [
                "nombre" => "SAN JUAN DEL RIO COCO",
                "departamento_id" => 12
            ],
            [
                "nombre" => "SAN LUCAS",
                "departamento_id" => 12
            ],
            [
                "nombre" => "SOMOTO",
                "departamento_id" => 12
            ],
            [
                "nombre" => "TELPANECA",
                "departamento_id" => 12
            ],
            [
                "nombre" => "TOTOGALPA",
                "departamento_id" => 12
            ],
            [
                "nombre" => "YALAGUINA",
                "departamento_id" => 12
            ]
        ]);

        //MATAGALPA


        DB::table('municipios')->insert([
            [
                "nombre" => "BOCANA DE PAIWAS",
                "departamento_id" => 13
            ],
            [
                "nombre" => "CIUDAD DARIO",
                "departamento_id" => 13
            ],
            [
                "nombre" => "EL TUMA - LA DALIA",
                "departamento_id" => 13
            ],
            [
                "nombre" => "ESQUIPULAS",
                "departamento_id" => 13
            ],
            [
                "nombre" => "MATAGALPA",
                "departamento_id" => 13
            ],
            [
                "nombre" => "MATIGUAS",
                "departamento_id" => 13
            ],
            [
                "nombre" => "MUY MUY",
                "departamento_id" => 13
            ],
            [
                "nombre" => "RANCHO GRANDE",
                "departamento_id" => 13
            ],
            [
                "nombre" => "RIO BLANCO",
                "departamento_id" => 13
            ],
            [
                "nombre" => "SAN DIONISIO",
                "departamento_id" => 13
            ],
            [
                "nombre" => "SAN ISIDRO",
                "departamento_id" => 13
            ],
            [
                "nombre" => "SAN RAMON",
                "departamento_id" => 13
            ],
            [
                "nombre" => "SEBACO",
                "departamento_id" => 13
            ],
            [
                "nombre" => "TERRABONA",
                "departamento_id" => 13
            ]
        ]);

        //Nueva segovia


        DB::table('municipios')->insert([
            [
                "nombre" => "CIUDAD ANTIGUA",
                "departamento_id" => 14
            ],
            [
                "nombre" => "DIPILTO",
                "departamento_id" => 14
            ],
            [
                "nombre" => "EL JICARO",
                "departamento_id" => 14
            ],
            [
                "nombre" => "JALAPA",
                "departamento_id" => 14
            ],
            [
                "nombre" => "MACUELIZO",
                "departamento_id" => 14
            ],
            [
                "nombre" => "MOZONTE",
                "departamento_id" => 14
            ],
            [
                "nombre" => "MURRA",
                "departamento_id" => 14
            ],
            [
                "nombre" => "OCOTAL",
                "departamento_id" => 14
            ],
            [
                "nombre" => "QUILALI",
                "departamento_id" => 14
            ],
            [
                "nombre" => "SAN FERNANDO",
                "departamento_id" => 14
            ],
            [
                "nombre" => "SANTA MARIA",
                "departamento_id" => 14
            ],
            [
                "nombre" => "WIWILI DE ABAJO",
                "departamento_id" => 14
            ]
        ]);

        // Rio San Juan


        DB::table('municipios')->insert([
            [
                "nombre" => "EL ALMENDRO",
                "departamento_id" => 15
            ],
            [
                "nombre" => "EL CASTILLO",
                "departamento_id" => 15
            ],
            [
                "nombre" => "MORRITO",
                "departamento_id" => 15
            ],
            [
                "nombre" => "SAN CARLOS",
                "departamento_id" => 15
            ],
            [
                "nombre" => "SAN JUAN DE NICARAGUA",
                "departamento_id" => 15
            ],
            [
                "nombre" => "SAN MIGUELITO",
                "departamento_id" => 15
            ]
        ]);

        //RAAN


        DB::table('municipios')->insert([
            [
                "nombre" => "BONANZA",
                "departamento_id" => 16
            ],
            [
                "nombre" => "MULUKUKU",
                "departamento_id" => 16
            ],
            [
                "nombre" => "PRINZAPOLKA",
                "departamento_id" => 16
            ],
            [
                "nombre" => "PUERTO CABEZAS",
                "departamento_id" => 16
            ],
            [
                "nombre" => "ROSITA",
                "departamento_id" => 16
            ],
            [
                "nombre" => "SIUNA",
                "departamento_id" => 16
            ],
            [
                "nombre" => "WASLALA",
                "departamento_id" => 16
            ],
            [
                "nombre" => "WASPAN",
                "departamento_id" => 16
            ]
        ]);

        //RAAS


        DB::table('municipios')->insert([
            [
                "nombre" => "BLUEFIELDS",
                "departamento_id" => 17
            ],
            [
                "nombre" => "CORN ISLAND",
                "departamento_id" => 17
            ],
            [
                "nombre" => "DESEMBOCADURA DE RIO GRANDE",
                "departamento_id" => 17
            ],
            [
                "nombre" => "EL AYOTE",
                "departamento_id" => 17
            ],
            [
                "nombre" => "EL RAMA",
                "departamento_id" => 17
            ],
            [
                "nombre" => "KUKRAHILL",
                "departamento_id" => 17
            ],
            [
                "nombre" => "LA CRUZ DE RIO GRANDE",
                "departamento_id" => 17
            ],
            [
                "nombre" => "LAGUNA DE PERLAS",
                "departamento_id" => 17
            ],
            [
                "nombre" => "MUELLE DE LOS BUEYES",
                "departamento_id" => 17
            ],
            [
                "nombre" => "NUEVA GUINEA",
                "departamento_id" => 17
            ],
            [
                "nombre" => "PAIWAS",
                "departamento_id" => 17
            ],
            [
                "nombre" => "TORTUGUERO",
                "departamento_id" => 17
            ]
        ]);


    }
}
