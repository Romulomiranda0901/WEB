<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Consolidado_arqueo extends Model
{
    public function listado_consolidado_arqueo($id_caja, $fecha)
    {
        $datos = DB::table('tesoreria.arqueo_caja_detalle as acd')
            ->join('tesoreria.arqueo_caja as ac','acd.id_arqueo','=','ac.id')
            ->join('general.tipo_moneda as tm','acd.id_tipo_moneda','=','tm.id')
            ->join('general.cat_denominaciones as cd','acd.id_cat_denominacion','=','cd.id')
            ->join('general.cat_moneda as cm','cd.id_cat_moneda','=','cm.id')
            ->where('ac.id_caja','=',$id_caja)
            ->where('ac.created_at','=',$fecha)
            ->select('ac.numero_arqueo','tm.id as tipo_moneda_id','tm.nombre as tipo_moneda','cm.nombre as tipo_valor_denominacion','cd.valor_denominaciones as denominaciones_valor','acd.cantidad')->get();


        $organizedData = [];

        foreach ($datos as $row) {
            $tipoMoneda = $row->tipo_moneda;
            $tipoValorDenominacion = $row->tipo_valor_denominacion;

            if (!isset($organizedData[$tipoMoneda])) {
                $organizedData[$tipoMoneda] = [];
            }

            if (!isset($organizedData[$tipoMoneda][$tipoValorDenominacion])) {
                $organizedData[$tipoMoneda][$tipoValorDenominacion] = [];
            }

            $organizedData[$tipoMoneda][$tipoValorDenominacion][] = [
                'numero_arqueo' => $row->numero_arqueo,
                'denominaciones_valor' => $row->denominaciones_valor,
                'cantidad' => $row->cantidad,
            ];
        }

        $recibos_efectivo = $this->listado_recibos_efectivo($id_caja, $fecha);
        $recibos_deposito = $this->listado_recibos_deposito($id_caja, $fecha);
        $recibos_cheque = $this->listado_recibos_cheque($id_caja, $fecha);

        $datos = ['arqueo'=>$organizedData,'recibos_efectivo'=>$recibos_efectivo,'recibos_deposito'=>$recibos_deposito,'recibos_cheque'=>$recibos_cheque];
        return $datos;
    }



    public function listado_recibos_efectivo($id_caja, $fecha){

        $datoss =  DB::table('tesoreria.arqueo_caja as ac')
            ->join('tesoreria.recibos as r',DB::raw('DATE(r.created_at)'),'=', DB::raw('DATE(ac.created_at)'))
            ->join('general.clientes as c','r.id_cliente','=','c.id')
            ->join('tesoreria.arqueo_caja_detalle as acd','acd.id_arqueo','ac.id')
            ->join('tesoreria.recibos_detalle as rd','rd.id_recibos','=','r.id')
            ->join('general.tipopago as tp','rd.id_tipo_pagp','=','tp.id')
            ->select('r.numero_recibo','tp.nombre as tipo_pago','r.monto','c.nombres','c.apellidos')
            ->where('r.id_caja','=',$id_caja)
            ->where('r.activo','=','SI')
            ->where('r.eliminado','=','NO')
            ->where('r.id_forma_pago','=','1')
            ->where('r.finalizado','=','SI')
            ->where('r.created_at','=',$fecha)
            ->groupBy('r.numero_recibo','tipo_pago','r.monto','c.nombres','c.apellidos','acd.id_tipo_moneda as tipo_moneda')->get()
        ;

        $organizedData = [];

        foreach ($datoss as $row) {
            $tipoMoneda = $row->tipo_moneda;

            if (!isset($organizedData[$tipoMoneda])) {
                $organizedData[$tipoMoneda] = [];
            }

            $organizedData[$tipoMoneda][] = [
                'numero_recibo' => $row->numero_recibo,
                'tipo_pago' => $row->tipo_pago,
                'monto' => $row->monto,
                'nombres' => $row->nombres,
                'apellidos' => $row->apellidos,
            ];
        }



        return $organizedData;
    }

    public function listado_recibos_deposito($id_caja, $fecha){

        $datos =  DB::table('tesoreria.arqueo_caja as ac')
            ->join('tesoreria.recibos as r',DB::raw('DATE(r.created_at)'),'=', DB::raw('DATE(ac.created_at)'))
            ->join('general.clientes as c','r.id_cliente','=','c.id')
            ->join('tesoreria.arqueo_caja_detalle as acd','acd.id_arqueo','ac.id')
            ->join('tesoreria.recibos_detalle as rd','rd.id_recibos','=','r.id')
            ->join('general.tipopago as tp','rd.id_tipo_pagp','=','tp.id')
            ->select('r.numero_recibo','tp.nombre as tipo_pago','r.monto','r.numero_forma_pago','c.nombres','c.apellidos')
            ->where('r.id_caja','=',$id_caja)
            ->where('r.activo','=','SI')
            ->where('r.eliminado','=','NO')
            ->where('r.id_forma_pago','=','2')
            ->where('r.finalizado','=','SI')
            ->where('r.created_at','=',$fecha)
            ->groupBy('r.numero_recibo','tipo_pago','r.monto','r.numero_forma_pago','c.nombres','c.apellidos','acd.id_tipo_moneda as tipo_moneda')
            ->get()
        ;




        $organizedData = [];

        foreach ($datos as $row) {
            $tipoMoneda = $row->tipo_moneda;

            if (!isset($organizedData[$tipoMoneda])) {
                $organizedData[$tipoMoneda] = [];
            }

            $organizedData[$tipoMoneda][] = [
                'numero_recibo' => $row->numero_recibo,
                'tipo_pago' => $row->tipo_pago,
                'monto' => $row->monto,
                'numero_forma_pago'=>$row->numero_forma_pago,
                'nombres' => $row->nombres,
                'apellidos' => $row->apellidos,
            ];
        }
        return $datos;
    }


    public function listado_recibos_cheque($id_caja, $fecha){

        $datos =  DB::table('tesoreria.arqueo_caja as ac')
            ->join('tesoreria.recibos as r',DB::raw('DATE(r.created_at)'),'=', DB::raw('DATE(ac.created_at)'))
            ->join('general.clientes as c','r.id_cliente','=','c.id')
            ->join('tesoreria.arqueo_caja_detalle as acd','acd.id_arqueo','ac.id')
            ->join('tesoreria.recibos_detalle as rd','rd.id_recibos','=','r.id')
            ->join('general.tipopago as tp','rd.id_tipo_pagp','=','tp.id')
            ->select('r.numero_recibo','tp.nombre as tipo_pago','r.monto','r.numero_forma_pago','c.nombres','c.apellidos')
            ->where('r.id_caja','=',$id_caja)
            ->where('r.activo','=','SI')
            ->where('r.eliminado','=','NO')
            ->where('r.id_forma_pago','=','3')
            ->where('r.finalizado','=','SI')
            ->where('r.created_at','=',$fecha)
            ->groupBy('r.numero_recibo','tipo_pago','r.monto','r.numero_forma_pago','c.nombres','c.apellidos','acd.id_tipo_moneda as tipo_moneda')->get()
        ;



        $organizedData = [];

        foreach ($datos as $row) {
            $tipoMoneda = $row->tipo_moneda;

            if (!isset($organizedData[$tipoMoneda])) {
                $organizedData[$tipoMoneda] = [];
            }

            $organizedData[$tipoMoneda][] = [
                'numero_recibo' => $row->numero_recibo,
                'tipo_pago' => $row->tipo_pago,
                'monto' => $row->monto,
                'numero_forma_pago'=>$row->numero_forma_pago,
                'nombres' => $row->nombres,
                'apellidos' => $row->apellidos,
            ];
        }
        return $datos;
    }
}
