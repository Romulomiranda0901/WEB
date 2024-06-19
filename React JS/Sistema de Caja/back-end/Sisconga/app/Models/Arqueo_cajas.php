<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use function PHPUnit\Framework\exactly;

class Arqueo_cajas extends Model
{
    public function obtener_recibo_arqueo($id_caja,$id_tipo_moneda){;
        $primer_recibo = DB::table('tesoreria.recibos')
            ->where('finalizado','=','NO')->where('id_caja','=',$id_caja)->where('id_tipo_moneda','=',$id_tipo_moneda)->orderBy('id', 'asc')->limit(1)->pluck('numero_recibo');
        $ultimoRecibo  = DB::table('tesoreria.recibos')
            ->where('finalizado','=','NO')->where('id_caja','=',$id_caja)->where('id_tipo_moneda','=',$id_tipo_moneda)->orderBy('id', 'desc')->limit(1)->pluck('numero_recibo');


        $array = $primer_recibo->all();
        $array2 = $ultimoRecibo->all();

        $recibos = ['Primer_recibo'=>$array,'Ultimo_recibo'=>$array2];
        return $recibos;
    }

    public function obtener_recibos_deposito($id_usuario,$id_tipo_moneda){
        $fechaActual = Carbon::now();
        $resultados  = DB::table('tesoreria.recibos')
            ->whereDate('created_at','=',$fechaActual)
            ->where('finalizado','=','NO')
            ->where('id_caja','=',$id_usuario)
            ->where('id_tipo_moneda','=',$id_tipo_moneda)
            ->where('id_forma_pago','=','2')
            ->select('numero_recibo','numero_forma_pago','monto','created_at')
            ->get();


       // $total = $resultados->toArray();
        $total = json_decode($resultados, true);



        return  $total;
    }

    public function obtener_recibos_cheques($id_usuario,$id_tipo_moneda){
        $fechaActual = Carbon::now();
        $resultados = DB::table('tesoreria.recibos')
            ->whereDate('created_at','=',$fechaActual)
            ->where('finalizado','=','NO')
            ->where('id_caja','=',$id_usuario)
            ->where('id_tipo_moneda','=',$id_tipo_moneda)
            ->where('id_forma_pago','=','3')
            ->select('numero_recibo','numero_forma_pago','monto','created_at')
        ->get();

        $total = json_decode($resultados, true);
        //$total = $resultados->toArray();

        return  $total;
    }

    public function obtener_ultimo_arqueo($id_caja){
        $ultimoarqueo  = DB::table('tesoreria.arqueo_caja')
           ->where('id_caja','=',$id_caja)->orderBy('id', 'desc')->limit(1)->pluck('numero_arqueo');

        $ultimoarqueo =$ultimoarqueo->all();

        return $ultimoarqueo;

    }


    public function obtener_total_arquear($id_caja,$id_tipo_moneda){
        $fechaActual = Carbon::now();
        $total = DB::table('tesoreria.recibos')
            ->whereDate('created_at','=', $fechaActual)
            ->where('finalizado','=','NO')
            ->where('id_forma_pago','=','1')
            ->where('id_caja','=',$id_caja)
            ->where('id_tipo_moneda','=',$id_tipo_moneda)
            ->sum('monto');




        $total = ['total_caja'=>$total,'recibos_deposito'=>$this->obtener_recibos_deposito($id_caja,$id_tipo_moneda),'recibos_cheque'=>$this->obtener_recibos_cheques($id_caja,$id_tipo_moneda)];

        return $total;
    }

    public function informacion_caja_arqueo($id_caja){
        $fechaActual = Carbon::now();
        $fechaFormateada = $fechaActual->format('d-m-Y H:i:s');
        $ultimoarqueo = $this->obtener_ultimo_arqueo($id_caja);
        $this->cerrar_caja($id_caja);

        $informacion = DB::table('general.permisos_usuario_caja as pua')
            ->join('configuracion.usuarios as u','pua.id_usuario','=','u.id')
            ->join('general.organicas_cajas as oc','pua.id_caja','=','oc.id')
            ->where('oc.id','=',$id_caja)
            ->select('u.nombres', 'u.apellidos', 'oc.id','oc.nombre as caja_nombre')
            ->first();

        $informacion = (array) $informacion;


        $informacion['Fecha_de_apertura_caja'] = $fechaFormateada;
        $informacion['Ultimo_arqueo'] = $ultimoarqueo;

        return $informacion;
    }


    public function cerrar_caja($id_caja){
        try {
            $resultado =   DB::transaction(function () use ($id_caja) {
                DB::table('general.organicas_cajas')->where('id', '=', $id_caja)
                    ->where('activo', '=', 'SI')
                    ->update(['estado' => false]);
            });

            return $resultado;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function aperturar_caja($id_caja){
        try {
            $resultado =   DB::transaction(function () use ($id_caja) {
                DB::table('general.organicas_cajas')->where('id', '=', $id_caja)
                    ->where('activo', '=', 'SI')
                    ->update(['estado' => true]);
            });

            return $resultado;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function denominaciones ($id_tipo_moneda){
        try {
            $datos = DB::table('general.cat_denominaciones as cd')
            ->join('general.cat_moneda as cm','cd.id_cat_moneda','=','cm.id')
            ->select('cd.id','cm.nombre','cd.valor_denominaciones')
            ->where('cd.id_tipo_moneda','=',$id_tipo_moneda)
            ->orderBy('cm.nombre')
            ->orderBy('cd.valor_denominaciones')
            ->orderBy('cd.id')->get();
            $datos =  json_decode($datos, true);


            $datosOrdenados = collect($datos)->sortBy('valor_denominaciones')->values()->all();
            $grupos = [];

            foreach ($datosOrdenados as $item) {
                $nombre = $item['nombre'];

                // Si el grupo aún no existe, inicialízalo
                if (!isset($grupos[$nombre])) {
                    $grupos[$nombre] = [];
                }

                // Agrega el elemento al grupo correspondiente
                $grupos[$nombre][] = $item;
            }


            return $grupos;

        }catch (\Exception $e){

        }
    }


    // Función de comparación para ordenar por 'valor_denominaciones'
    function compararPorDenominaciones($a, $b) {
        return $a['valor_denominaciones'] - $b['valor_denominaciones'];
    }



    public function guardar_arqueo($id_caja,$id_usuario,$anyo,$observacion,$sobrante_faltante,$datos){
        try {
            $ultimo_aarqueo = $this->obtener_ultimo_arqueo($id_caja);

           if(!empty($ultimo_aarqueo))
           {
               $ultimo_aarqueo = (int)$ultimo_aarqueo[0]+1;
           }
           else{
               $ultimo_aarqueo=1;
           }



          $resultado =  DB::transaction(function () use ($id_caja,$id_usuario,$anyo,$observacion,$ultimo_aarqueo,$sobrante_faltante,$datos) {

                $datos1 = [
                    'id_caja' => $id_caja,
                    'id_usuario' => $id_usuario,
                    'numero_arqueo' => $ultimo_aarqueo,
                    'anyo' => $anyo,
                    'observacion' => $observacion,
                    'created_at'=> date("Y-m-d H:i:s")
                ];




                $idarqueo = DB::table('tesoreria.arqueo_caja')->insertGetId($datos1);
                if ($sobrante_faltante>0  || $sobrante_faltante<0){
                    $datos_sobrante =
                        ['id_tipo_moneda'=>$datos[0]['id_tipo_moneda'],
                         'id_caja'=>$id_caja,
                         'id_arqueo'=>$idarqueo,
                         'monto'=>$sobrante_faltante,
                         'anyo'=>$anyo,
                         'created_at'=> date("Y-m-d H:i:s")
                         ];




                   DB::table('tesoreria.arqueofaltantessobrante')->insert($datos_sobrante);

                    // crear metodo de envio de correo
                 $datos_caja= $this->obtener_informacion_caja($id_caja);

                  if ($sobrante_faltante>0){
                      $sobrante = 'sobrante';
                  }
                  else{
                      $sobrante = 'faltante';
                  }

                    $datos_caja[0][$sobrante] = $sobrante_faltante;

                 /*   Mail::to('maria.sandino@unpggl.edu.ni')->send($datos_caja);
                    Mail::to('romulo.miranda@unpggl.edu.ni')->send($datos_caja);*/


                }
                $this->guardar_arqueo_detalle($datos,$idarqueo);

                $this->actulizar_recibos($id_caja,$idarqueo,$datos[0]['id_tipo_moneda']);
                $this->aperturar_caja($id_caja);
                return $idarqueo;

            });

          return $resultado ;

        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }


    public function actulizar_recibos($id_caja,$idarqueo,$tipo_moneda){

            try {

                $recibos =  DB::table('tesoreria.arqueo_caja as ac')
                    ->join('tesoreria.recibos as r',DB::raw('DATE(r.created_at)'),'=', DB::raw('DATE(ac.created_at)'))
                    ->select('r.id')
                    ->where('ac.id','=',$idarqueo)
                    ->where('r.activo','=','SI')
                    ->where('r.eliminado','=','NO')
                    ->where('r.id_caja','=',$id_caja)
                    ->where('r.id_tipo_moneda','=',$tipo_moneda)
                    ->where('r.finalizado','=','NO')
                    ->groupBy('r.id')->get();


                $recibos = json_decode($recibos,true);

                $resultado =    DB::transaction(function () use ($recibos) {
                    DB::table('tesoreria.recibos')->whereIn('id', $recibos)
                        ->where('activo','=','SI')
                        ->update(['finalizado'=>'SI']);

                });

                return $resultado ;
            }catch (\Exception $e){
                throw new \Exception($e->getMessage());
            }
    }



    public function obtener_informacion_caja($id_caja){
        $datos = DB::table('general.permisos_usuario_caja  as puc')
            ->join('general.organicas_cajas as oc','oc.id','=','puc.id_caja')
            ->join('configuracion.usuarios as u','puc.id_usuario','=','u.id')
            ->select('u.nombres','u.apellidos','oc.nombre')
            ->where('oc.id','=',$id_caja)->get();
        $datos =  json_decode($datos, true);

        return $datos;
    }

    public function guardar_arqueo_detalle ($datos,$idarqueo){

        $array = [];
        foreach ($datos as $dato){
            $array [] = ['id_tipo_moneda'=>$dato['id_tipo_moneda'],'id_cat_denominacion'=>$dato['id_cat_denominacion'],'cantidad'=>$dato['cantidad'],'id_arqueo'=>$idarqueo,'created_at'=>date("Y-m-d H:i:s")];
        }

        DB::table('tesoreria.arqueo_caja_detalle')->insert($array);
    }

    public function ver_arqueo($idarqueo){
        try {

            $datos = DB::table('tesoreria.arqueo_caja_detalle as acd')
             ->join('tesoreria.arqueo_caja as ac','acd.id_arqueo','=','ac.id')
            ->join('general.tipo_moneda as tm','acd.id_tipo_moneda','=','tm.id')
            ->join('general.cat_denominaciones as cd','acd.id_cat_denominacion','=','cd.id')
            ->join('general.cat_moneda as cm','cd.id_cat_moneda','=','cm.id')
            ->where('acd.id_arqueo','=',$idarqueo)
            ->select('ac.numero_arqueo','tm.id as tipo_moneda_id','tm.nombre as tipo_moneda','cm.nombre as tipo_valor_denominacion','cd.valor_denominaciones as denominaciones_valor','acd.cantidad')->get();


            $datos =  json_decode($datos, true);

            // Agrupar por la clave "tipo_valor_denominacion"
            $arqueoAgrupado = collect($datos)->groupBy('tipo_valor_denominacion')->toArray();





            $tipo_moneda_id = $datos[0]['tipo_moneda_id'];


            $recibos_efectivo = $this->listado_recibos_efectivo($idarqueo,$tipo_moneda_id);
            $recibos_deposito = $this->listado_recibos_deposito($idarqueo,$tipo_moneda_id);
            $recibos_cheque = $this->listado_recibos_cheque($idarqueo,$tipo_moneda_id);


            $datos = ['arqueo'=>$arqueoAgrupado,'recibos_efectivo'=>$recibos_efectivo,'recibos_deposito'=>$recibos_deposito,'recibos_cheque'=>$recibos_cheque];
            return $datos;



        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }


    public function listado_arqueo($id_caja){
        try {
            $datos = DB::table('tesoreria.arqueo_caja')
                ->select('id','numero_arqueo','created_at as fecha')
                ->where('id_caja','=',$id_caja)->get();

            return $datos;


        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }


    public function listado_recibos_efectivo($id_arqueo,$id_tipo_moenda){

        $datoss =  DB::table('tesoreria.arqueo_caja as ac')
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

       $datoss =  json_decode($datoss, true);

        return $datoss;
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
            ->groupBy('r.numero_recibo','tipo_pago','r.monto','r.numero_forma_pago','c.nombres','c.apellidos')
            ->get()
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


}
