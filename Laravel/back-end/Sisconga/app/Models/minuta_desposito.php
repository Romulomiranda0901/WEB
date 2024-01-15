<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class minuta_desposito extends Model
{
   public function ver_listado($id_caja,$anyo){
      $datos =  DB::table('tesoreria.minuta_deposito as md')
       ->join('tesoreria.minuta_deposito_detalle as mpd','mpd.id_minuta','=','md.id')
       ->join('tesoreria.arqueo_caja as ac','md.id_arqueo','=','ac.id')
       ->join('tesoreria.arqueo_caja_detalle as acd','acd.id_arqueo','=','ac.id')
       ->join('general.tipo_moneda as tm','acd.id_tipo_moneda','=','tm.id')
       ->join('general.cuenta_banco as cb','mpd.id_cuenta_banco','=','cb.id')
       ->select('md.numuero_minuta','md.numuero_deposito','ac.numero_arqueo','cb.cuenta','tm.nombre as tipo_moneda','mpd.monto','md.finalizado','md.id')
       ->where('ac.id_caja','=',$id_caja)
       ->where('md.anyo','=',$anyo)
       ->where('md.activo','=','SI')
       ->where('md.eliminado','=','NO')
       ->groupBy('md.numuero_minuta','md.numuero_deposito','ac.numero_arqueo','cb.cuenta','tm.nombre','mpd.monto','md.finalizado','md.id')->get()
       ;

       $datos =  json_decode($datos, true);
      return $datos;

   }

    public function busqueda_arqueo($mumero_arqueo){
        $datos =  DB::table('tesoreria.arqueo_caja as ac')
            ->join('tesoreria.arqueo_caja_detalle as acd','acd.id_arqueo','=','ac.id')
            ->join('general.tipo_moneda as tm','acd.id_tipo_moneda','=','tm.id')
            ->select('ac.numero_arqueo','tm.nombre as tipo_moneda','ac.id','tm.id as id_moneda')
            ->where('ac.numero_arqueo','ilike',"%$mumero_arqueo%")
            ->where('ac.activo','=','SI')
            ->where('ac.eliminado','=','NO') ->groupBy('ac.numero_arqueo', 'tm.nombre', 'ac.id', 'tm.id')->get()
        ;


        $datos =  json_decode($datos, true);
        return $datos;

    }

    public function cuentas($id_tipo_moneda){

        $datos =  DB::table('general.cuenta_banco as cb')
            ->join('general.banco as b','cb.id_banco','=','b.id')
            ->select('cb.cuenta','b.nombre as banco','cb.id')
            ->where('cb.tipo_cuenta','=',$id_tipo_moneda)
            ->where('cb.activo','=','SI')
            ->where('cb.eliminado','=','NO')
            ->get()
        ;

        $datos =  json_decode($datos, true);
        return $datos;
    }



    public function listado_recibos($id_arqueo,$id_tipo_moenda){

        $recibos_efectivo = $this->listado_recibos_efectivo($id_arqueo,$id_tipo_moenda);
        $recibos_deposito = $this->listado_recibos_deposito($id_arqueo,$id_tipo_moenda);
        $recibos_cheque = $this->listado_recibos_cheque($id_arqueo,$id_tipo_moenda);

        $groupedReceipts = [];
        foreach ($recibos_efectivo as $receipt) {
            $name = $receipt['nombres'];
            $paymentType = $receipt['tipo_pago'];

            // Create a nested array if not exists
            if (!isset($groupedReceipts[$name])) {
                $groupedReceipts[$name] = [];
            }

            // Create a nested array for the payment type if not exists
            if (!isset($groupedReceipts[$name][$paymentType])) {
                $groupedReceipts[$name][$paymentType] = [];
            }

            // Add the receipt to the grouped structure
            $groupedReceipts[$name][$paymentType][] = $receipt;
        }
        $groupedReceipts_deposito = [];
        foreach ($recibos_deposito as $receipt) {
            $name = $receipt['nombres'];
            $paymentType = $receipt['tipo_pago'];

            // Create a nested array if not exists
            if (!isset($groupedReceipts_deposito[$name])) {
                $groupedReceipts_deposito[$name] = [];
            }

            // Create a nested array for the payment type if not exists
            if (!isset($groupedReceipts_deposito[$name][$paymentType])) {
                $groupedReceipts_deposito[$name][$paymentType] = [];
            }

            // Add the receipt to the grouped structure
            $groupedReceipts_deposito[$name][$paymentType][] = $receipt;
        }
        $groupedReceipts_cheque = [];
        foreach ($recibos_cheque as $receipt) {
            $name = $receipt['nombres'];
            $paymentType = $receipt['tipo_pago'];

            // Create a nested array if not exists
            if (!isset($groupedReceipts_cheque[$name])) {
                $groupedReceipts_cheque[$name] = [];
            }

            // Create a nested array for the payment type if not exists
            if (!isset($groupedReceipts_cheque[$name][$paymentType])) {
                $groupedReceipts_cheque[$name][$paymentType] = [];
            }

            // Add the receipt to the grouped structure
            $groupedReceipts_cheque[$name][$paymentType][] = $receipt;
        }

        $datos = ['recibos_efectivo'=>$groupedReceipts,'recibos_deposito'=>$groupedReceipts_deposito,'recibos_cheque'=>$groupedReceipts_cheque];
        return $datos;
    }

    public function listado_recibos_efectivo($id_arqueo,$id_tipo_moenda){

        $datos =  DB::table('tesoreria.arqueo_caja as ac')
            ->join('tesoreria.recibos as r',DB::raw('DATE(r.created_at)'),'=', DB::raw('DATE(ac.created_at)'))
            ->join('general.clientes as c','r.id_cliente','=','c.id')
            ->join('tesoreria.arqueo_caja_detalle as acd','acd.id_arqueo','ac.id')
            ->join('tesoreria.recibos_detalle as rd','rd.id_recibos','=','r.id')
            ->join('general.tipopago as tp','rd.id_tipo_pagp','=','tp.id')
            ->select('r.numero_recibo','tp.nombre as tipo_pago','r.monto','c.nombres','c.apellidos')
            ->where('ac.id','=',$id_arqueo)
            ->where('r.activo','=','SI')
            ->where('r.eliminado','=','NO')
            ->where('r.id_forma_pago','=','1')
            ->where('r.finalizado','=','SI')
            ->where('acd.id_tipo_moneda','=',$id_tipo_moenda)
            ->groupBy('r.numero_recibo','tipo_pago','r.monto','c.nombres','c.apellidos')->get()
        ;

        $datos =  json_decode($datos, true);
        return $datos;
    }

    public function listado_recibos_deposito($id_arqueo,$id_tipo_moenda){

        $datos =  DB::table('tesoreria.arqueo_caja as ac')
            ->join('tesoreria.recibos as r',DB::raw('DATE(r.created_at)'),'=', DB::raw('DATE(ac.created_at)'))
            ->join('general.clientes as c','r.id_cliente','=','c.id')
            ->join('tesoreria.arqueo_caja_detalle as acd','acd.id_arqueo','ac.id')
            ->join('tesoreria.recibos_detalle as rd','rd.id_recibos','=','r.id')
            ->join('general.tipopago as tp','rd.id_tipo_pagp','=','tp.id')
            ->select('r.numero_recibo','tp.nombre as tipo_pago','r.monto','r.numero_forma_pago','c.nombres','c.apellidos')
            ->where('ac.id','=',$id_arqueo)
            ->where('r.activo','=','SI')
            ->where('r.eliminado','=','NO')
            ->where('r.id_forma_pago','=','2')
            ->where('r.finalizado','=','SI')
            ->where('acd.id_tipo_moneda','=',$id_tipo_moenda)
            ->groupBy('r.numero_recibo','tipo_pago','r.monto','r.numero_forma_pago','c.nombres','c.apellidos')->get()
        ;

        $datos =  json_decode($datos, true);
        return $datos;
    }


    public function listado_recibos_cheque($id_arqueo,$id_tipo_moenda){

        $datos =  DB::table('tesoreria.arqueo_caja as ac')
            ->join('tesoreria.recibos as r',DB::raw('DATE(r.created_at)'),'=', DB::raw('DATE(ac.created_at)'))
            ->join('general.clientes as c','r.id_cliente','=','c.id')
            ->join('tesoreria.arqueo_caja_detalle as acd','acd.id_arqueo','ac.id')
            ->join('tesoreria.recibos_detalle as rd','rd.id_recibos','=','r.id')
            ->join('general.tipopago as tp','rd.id_tipo_pagp','=','tp.id')
            ->select('r.numero_recibo','tp.nombre as tipo_pago','r.monto','r.numero_forma_pago','c.nombres','c.apellidos')
            ->where('ac.id','=',$id_arqueo)
            ->where('r.activo','=','SI')
            ->where('r.eliminado','=','NO')
            ->where('r.id_forma_pago','=','3')
            ->where('r.finalizado','=','SI')
            ->where('acd.id_tipo_moneda','=',$id_tipo_moenda)
            ->groupBy('r.numero_recibo','tipo_pago','r.monto','r.numero_forma_pago','c.nombres','c.apellidos')->get()
        ;

        $datos =  json_decode($datos, true);
        return $datos;
    }

    public function totales($id_arqueo,$id_tipo_moenda){

        $datos_recibos =  DB::table('tesoreria.arqueo_caja as ac')
            ->join('tesoreria.recibos as r', DB::raw('DATE(r.created_at)'), '=', DB::raw('DATE(ac.created_at)'))
            ->join('tesoreria.arqueo_caja_detalle as acd','acd.id_arqueo','ac.id')
            ->where('ac.id','=',$id_arqueo)
            ->where('r.activo','=','SI')
            ->where('r.eliminado','=','NO')
            ->where('acd.id_tipo_moneda','=',$id_tipo_moenda)->sum('r.monto');



        $datos_arqueo =  DB::table('tesoreria.arqueo_caja as ac')
            ->join('tesoreria.recibos as r', DB::raw('DATE(r.created_at)'), '=', DB::raw('DATE(ac.created_at)'))
            ->join('tesoreria.arqueo_caja_detalle as acd','acd.id_arqueo','ac.id')
            ->join('tesoreria.recibos_detalle as rd','rd.id_recibos','=','r.id')
            ->join('general.cat_denominaciones as cd','acd.id_cat_denominacion','=','cd.id')
            ->where('ac.id','=',$id_arqueo)
            ->where('r.activo','=','SI')
            ->where('r.eliminado','=','NO')
            ->where('acd.id_tipo_moneda','=',$id_tipo_moenda)->selectRaw('SUM(CAST(cd.valor_denominaciones AS INT)*CAST(acd.cantidad AS INT)) as total')->first();




        $datos = ['total_recibos'=>$datos_recibos,'total_arqueo'=>$datos_arqueo->total];
        return $datos;
    }


    public function ver($id_minuta){
        $datos =  DB::table('tesoreria.minuta_deposito as md')
            ->join('tesoreria.minuta_deposito_detalle as mpd','mpd.id_minuta','=','md.id')
            ->join('tesoreria.arqueo_caja as ac','md.id_arqueo','=','ac.id')
            ->join('tesoreria.arqueo_caja_detalle as acd','acd.id_arqueo','=','ac.id')
            ->join('general.tipo_moneda as tm','acd.id_tipo_moneda','=','tm.id')
            ->join('general.cuenta_banco as cb','mpd.id_cuenta_banco','=','cb.id')
            ->join('general.banco as b','cb.id_banco','=','b.id')
            ->select('ac.numero_arqueo','tm.nombre as tipo_moneda','md.numuero_deposito','cb.cuenta','b.nombre as banco','ac.id as id_arqueo','tm.id as id_tipo_moneda','md.id as id_minuta','md.finalizado')
            ->where('md.id','=',$id_minuta)
            ->where('md.activo','=','SI')
            ->where('md.eliminado','=','NO')
            ->groupBy('ac.numero_arqueo','tm.nombre','md.numuero_deposito','cb.cuenta','b.nombre','ac.id','tm.id','md.id','md.finalizado')->get()
        ;

        $datos = json_decode($datos,true);


        $listado_recibos = $this->listado_recibos($datos[0]['id_arqueo'],$datos[0]['id_tipo_moneda']);
        $totales = $this->totales($datos[0]['id_arqueo'],$datos[0]['id_tipo_moneda']);

     //   $listado_recibos =  json_decode($listado_recibos, true);
    //    $totales =  json_decode($totales, true);


        $dato = ['datos_principales'=>$datos,'listado_recibos'=>$listado_recibos,'totales'=>$totales];

        return $dato;
    }

    public function finalizado($id_minuta){
        try {
            $resultado =    DB::transaction(function () use ($id_minuta) {
                DB::table('tesoreria.minuta_deposito')->where('id','=',$id_minuta)
                    ->where('activo','=','SI')
                    ->update(['finalizado'=>'SI']);


            });

           return $resultado ;
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }


    public function guardar($id_arqueo,$numero_deposito,$monto,$id_cuenta,$id_usuario,$anyo){
        try {
            $ultmima_minuta = $this->ultimo_minuta($id_usuario,$anyo);

            if ($ultmima_minuta) {
                $numeroMinuta = $ultmima_minuta->numuero_minuta+1;

            } else {
                $numeroMinuta = 1;
            }

            $resultado =    DB::transaction(function () use ($id_arqueo,$numero_deposito,$monto,$id_cuenta,$numeroMinuta,$id_usuario,$anyo) {
                $datos=['numuero_minuta'=>$numeroMinuta,
                        'numuero_deposito'=>$numero_deposito,
                        'id_arqueo'=>$id_arqueo,
                        'id_usuario'=>$id_usuario,
                        'anyo'=>$anyo,
                        'created_at'=>date("Y-m-d H:i:s")
                    ];

                $id_minuta = DB::table('tesoreria.minuta_deposito')->insertGetId($datos);
                $this->guardar_detalle($id_minuta,$id_cuenta,$monto);
                return $id_minuta;


            });

            return $resultado;

        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }


    public function guardar_detalle($id_minuta,$id_cuenta,$monto){
        try {

            $datos=['id_minuta'=>$id_minuta,
                'id_cuenta_banco'=>$id_cuenta,
                'monto'=>$monto,
                'created_at'=>date("Y-m-d H:i:s")
            ];


            DB::table('tesoreria.minuta_deposito_detalle')->insert($datos);

        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function ultimo_minuta($id_usuario,$anyo){
     $datos =   DB::table('tesoreria.minuta_deposito')
           ->where('id_usuario','=',$id_usuario)
           ->where('anyo','=',$anyo)
           ->latest()->first();
     return $datos;
    }

}
