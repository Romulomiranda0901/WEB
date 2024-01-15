<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cuenta_por_cobrar extends Model
{
    public function ver($id_cuenta_por_pagar)
    {
        try {

            $datos =  DB::table('tesoreria.cuenta_por_pagar_detalle as cpgd')
                ->join('tesoreria.cuenta_por_pagar as cpg', 'cpgd.id_cuenta_por_pagar', '=', 'cpg.id')
                ->join('general.tipopago as tp', 'cpg.id_tipopago', '=', 'tp.id')
                ->join('general.clientes as c', 'cpgd.id_cliente', '=', 'c.id')
                ->join('general.carrera_sede as cs', 'c.id_carrera_sede', '=', 'cs.id')
                ->join('general.carreras as ca', 'cs.id_carrera', '=', 'ca.id')
                ->join('general.organicas_cajas as oc', 'cpg.id_caja', '=', 'oc.id')
                ->leftJoin('general.meses as m','cpg.id_mes','=','m.id')
                ->where('cpg.id', '=', $id_cuenta_por_pagar)
                ->select(
                    'cpg.id',
                    'cpg.numero_documento',
                    'tp.nombre as tipo_pago',
                    'm.nombre as mes',
                    'oc.nombre as caja',
                    'c.nombres',
                    'c.carnet',
                    'c.apellidos',
                    'ca.nombre as carrera',
                    'cpgd.monto'

                )->groupBy('cpg.id',
                    'cpg.numero_documento',
                    'tipo_pago',
                    'mes',
                    'caja',
                    'c.nombres',
                    'c.carnet',
                    'c.apellidos',
                    'carrera',
                    'cpgd.monto')->get();

            $datos = json_decode($datos, true);

            return $datos;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }


    public function guardar($id_cliente, $id_tipopago, $id_caja, $id_mes, $datos_detalle)
    {
        $numeroDocumento = $this->obtener_ultima_cuenta($id_caja);

        try {
            $resultado =    DB::transaction(function () use ($id_cliente, $id_tipopago, $id_caja, $id_mes,$numeroDocumento, $datos_detalle) {

                $datos = [
                    'id_cliente' => $id_cliente,
                    'id_tipopago' => $id_tipopago,
                    'id_caja' => $id_caja,
                    'id_mes' => isset($item['id_mes']) ? $item['id_mes'] : null,
                    'numero_documento' => $numeroDocumento,
                    'created_at' => date("Y-m-d H:i:s")
                ];

                $idInsertado = DB::table('tesoreria.cuenta_por_pagar')->insertGetId($datos);

                foreach ($datos_detalle as $item) {
                    $tipos_pagos[] = [
                        'id_cuenta_por_pagar' => $idInsertado,
                        'id_cliente' => $item['id_cliente'],
                        'monto' => $item['monto'],
                        'created_at' => date("Y-m-d H:i:s")
                    ];
                }

                DB::table('tesoreria.cuenta_por_pagar_detalle')->insert($tipos_pagos);

                return $idInsertado;
            });

            return $resultado;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

   public function listado($id_caja)
   {
       try {

           $datos =  DB::table('tesoreria.cuenta_por_pagar as cpg')
               ->where('cpg.id_caja', '=', $id_caja)
               ->select(
                   'cpg.id',
                   'cpg.numero_documento',
                   'cpg.created_at'

               )->groupBy('cpg.id',
                   'cpg.numero_documento',
                   'cpg.created_at')->get();

           $datos = json_decode($datos, true);

           return $datos;
       } catch (\Exception $e) {
           throw new \Exception($e->getMessage());
       }
   }

   public function obtener_ultima_cuenta($id_caja)
   {
       try {

           $ultimoNumero = DB::table('tesoreria.cuenta_por_pagar as cpg')
               ->where('cpg.id_caja', '=', $id_caja)
               ->select('cpg.numero_documento')
               ->orderByDesc('cpg.numero_documento')  // Ordenar en orden descendente
               ->first();
           if ($ultimoNumero) {
               $numeroDocumento = $ultimoNumero->numero_documento +1;

           } else {
               $numeroDocumento = 1;
           }
           return $numeroDocumento;
       } catch (\Exception $e) {
           throw new \Exception($e->getMessage());
       }
   }
}
