<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configuracion.submenus')->insert([
        [
            "nombre" => "Creacion de Poa",
            "icono" =>  "fa-tasks",
            "created_at"=> date("Y-m-d H:i:s"),
            "id_menu"=> 2
        ],
        [
             "nombre" => "Aprobacion del Poa",
             "icono" =>  "fa-tasks",
             "created_at"=> date("Y-m-d H:i:s"),
             "id_menu"=> 2
         ],
         [
                "nombre" => "Evaluacion del Poa",
                "icono" =>  "fa-tasks",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 2
         ],
         [
                "nombre" => "solicitud de Presupuesto",
                "icono" =>  "fa-book",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 3
         ],
          [
                "nombre" => "Aprobacion de Presupuesto",
                "icono" =>  "fa-book",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 3
          ],
          [
                "nombre" => "Movimiento de Rubros",
                "icono" =>  "fa-book",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 3
          ],
          [
                "nombre" => "Aprobacion de Movimento de Rubros",
                "icono" =>  "fa-book",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 3
          ],
            [
                "nombre" => "Personal",
                "icono" =>  "fa-users",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 4
            ],
            [
                "nombre" => "Nomina",
                "icono" =>  "fa-users",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 4
            ],
            [
                "nombre" => "Solicitudes de Compras",
                "icono" =>  "fa-money",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 5
            ],
            [
                "nombre" => "Aprobar solicitudes de Compras",
                "icono" =>  "fa-money",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 5
            ],
            [
                "nombre" => "Registro de Ingresos",
                "icono" =>  "fa-solid fa-store",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 6
            ],
            [
                "nombre" => " Arqueo de Caja",
                "icono" =>  "fa-solid fa-store",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 6
            ],
            [
                "nombre" => "Minutas de Depositos",
                "icono" =>  "fa-solid fa-store",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 6
            ],
            [
                "nombre" => "Gestion de Cheques",
                "icono" =>  "fa-solid fa-store",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 6
            ],
            [
                "nombre" => "Inventario",
                "icono" =>  "fa-cash-register",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 7
            ],
            [
                "nombre" => " Entradas",
                "icono" =>  "fa-cash-register",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 7
            ],
            [
                "nombre" => "salidas",
                "icono" =>  "fa-cash-register",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 7
            ],
            [
                "nombre" => "Anulacion de Entrada o Salidas",
                "icono" =>  "fa-cash-register",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 7
            ],
            [
                "nombre" => "Cierre de inventario",
                "icono" =>  "fa-cash-register",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 7
            ],
            [
                "nombre" => "Comprobante de ingresos de caja",
                "icono" =>  "fa-balance-scale",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 8
            ],
            [
                "nombre" => "Comprobante de ingresos Bancarios",
                "icono" =>  "fa-balance-scale",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 8
            ],
            [
                "nombre" => "Aprobar comprobante de Ingresos",
                "icono" =>  "fa-balance-scale",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 8
            ],
            [
                "nombre" => "Comprobante Diario",
                "icono" =>  "fa-balance-scale",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 8
            ],
            [
                "nombre" => "Anulacion comprobante y asientos",
                "icono" =>  "fa-balance-scale",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 8
            ],

            [
                "nombre" => "Planificacions",
                "icono" =>  "fa-file",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 9
            ],
            [
                "nombre" => "Presupuesto",
                "icono" =>  "fa-file",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 9
            ],
            [
                "nombre" => "RRHH",
                "icono" =>  "fa-file",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 9
            ],
            [
                "nombre" => "Compras",
                "icono" =>  "fa-file",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 9
            ],
            [
                "nombre" => "Tesoreria",
                "icono" =>  "fa-file",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 9
            ],
            [
                "nombre" => "Bodega",
                "icono" =>  "fa-file",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 9
            ],
            [
                "nombre" => "Contabilidad",
                "icono" =>  "fa-file",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 9
            ],
            [
                "nombre" => "Usuarios",
                "icono" =>  "fa-cog",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 10
            ],
            [
                "nombre" => "Configuracion de Caja",
                "icono" =>  "fa-cog",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 10
            ],
            [
                "nombre" => "Configuracion Techo Presupuestario ",
                "icono" =>  "fa-cog",
                "created_at"=> date("Y-m-d H:i:s"),
                "id_menu"=> 10
            ],

        ]);
    }
}
