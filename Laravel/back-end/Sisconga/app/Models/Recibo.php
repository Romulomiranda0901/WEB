<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Recibo extends Model
{
    public function listar_recibos($id_caja, $anyo_proceso)
    {
        try {
            $datos_cordoba = DB::table('tesoreria.recibos_detalle as rd')
                ->join('tesoreria.recibos as r', 'rd.id_recibos', '=', 'r.id')
                ->join('general.clientes as c', 'r.id_cliente', '=', 'c.id')
                ->join('general.organicas_cajas as oc', 'r.id_caja', '=', 'oc.id')
                ->join('general.tipo_moneda as tm', 'r.id_tipo_moneda', '=', 'tm.id')
                ->join('configuracion.usuarios as u', 'r.id_usuario', '=', 'u.id')
                ->leftJoin('tesoreria.recibos_anulados as ra', 'ra.id_recibos', '=', 'r.id')
                ->where('oc.id', '=', $id_caja)
                ->where('r.anyo', '=', $anyo_proceso)
                ->where('r.finalizado','=','NO')
            //    ->whereDate('r.created_at', '=', now()->toDateString()) // Filtra por el día actual
                ->where('r.id_tipo_moneda', '=', '1')
                ->where('r.finalizado','=','NO')// Filtra por tipo de moneda
                // ->select('r.id as id_recibo', 'r.numero_recibo as recibo_numero', DB::raw("CONCAT(c.nombres, ' ', c.apellidos) as nombre_completo"), 'tm.nombre as moneda', 'r.monto', 'ra.id as id_anulado')
                // ->selectRaw('CASE WHEN ra.id IS NULL THEN false ELSE true END AS anulado')
                //->groupBy('id_recibo', 'recibo_numero', 'nombre_completo', 'moneda', 'id_anulado', 'anulado')
                ->selectRaw('SUM(CASE WHEN ra.id IS NULL THEN r.monto ELSE 0 END) as monto_total') // Calcula el monto total
                ->get();

            $datos_dolares = DB::table('tesoreria.recibos_detalle as rd')
                ->join('tesoreria.recibos as r', 'rd.id_recibos', '=', 'r.id')
                ->join('general.clientes as c', 'r.id_cliente', '=', 'c.id')
                ->join('general.organicas_cajas as oc', 'r.id_caja', '=', 'oc.id')
                ->join('general.tipo_moneda as tm', 'r.id_tipo_moneda', '=', 'tm.id')
                ->join('configuracion.usuarios as u', 'r.id_usuario', '=', 'u.id')
                ->leftJoin('tesoreria.recibos_anulados as ra', 'ra.id_recibos', '=', 'r.id')
                ->where('oc.id', '=', $id_caja)
                ->where('r.anyo', '=', $anyo_proceso)
                ->where('r.finalizado','=','NO')
          //      ->whereDate('r.created_at', '=', now()->toDateString()) // Filtra por el día actual
                 ->where('r.id_tipo_moneda', '=', '2') // Filtra por tipo de moneda
                //->select('r.id as id_recibo', 'r.numero_recibo as recibo_numero', DB::raw("CONCAT(c.nombres, ' ', c.apellidos) as nombre_completo"), 'tm.nombre as moneda', 'r.monto', 'ra.id as id_anulado')
                // ->selectRaw('CASE WHEN ra.id IS NULL THEN false ELSE true END AS anulado')
                //  ->groupBy('id_recibo', 'recibo_numero', 'nombre_completo', 'moneda', 'id_anulado', 'anulado')
                ->selectRaw('SUM(CASE WHEN ra.id IS NULL THEN r.monto ELSE 0 END) as monto_total') // Calcula el monto total
                ->get();

            $recibos = DB::table('tesoreria.recibos_detalle as rd')
                ->select(
                    'r.id as id_recibo',
                    'r.numero_recibo as recibo_numero',
                    DB::raw("CONCAT(c.nombres, ' ', c.apellidos) as nombre_completo"),
                    'tm.nombre as moneda',
                    'r.monto',
                    'ra.id as id_anulado'
                )
                ->join('tesoreria.recibos as r', 'rd.id_recibos', '=', 'r.id')
                ->join('general.clientes as c', 'r.id_cliente', '=', 'c.id')
                ->join('general.organicas_cajas as oc', 'r.id_caja', '=', 'oc.id')
                ->join('general.tipo_moneda as tm', 'r.id_tipo_moneda', '=', 'tm.id')
                ->join('configuracion.usuarios as u', 'r.id_usuario', '=', 'u.id')
                ->leftJoin('tesoreria.recibos_anulados as ra', 'ra.id_recibos', '=', 'r.id')
                ->where('oc.id', '=', $id_caja)
                ->where('r.anyo', '=', $anyo_proceso)
                ->where('r.finalizado','=','NO')
                //->whereDate('r.created_at', '=', now()->toDateString()) // Filtra por el día actual
                // ->where('r.id_tipo_moneda', '=', '1') // Filtra por tipo de moneda
                ->selectRaw('CASE WHEN ra.id IS NULL THEN false ELSE true END AS anulado')
                ->groupBy('id_recibo', 'recibo_numero', 'nombre_completo', 'moneda', 'id_anulado', 'anulado')
                ->get();

            return [
                'datos_dolares' => $datos_dolares[0]->monto_total,
                'datos_cordoba' => $datos_cordoba[0]->monto_total,
                'recibos' => $recibos
            ];

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function listar_cajas($id_usuario)
    {
        try {

            if ($id_usuario === 1) {
                $datos =   DB::table('general.organicas_cajas as oc')
                    ->select('oc.id', 'oc.nombre', 'oc.estado')
                    ->where('oc.activo', '=', 'SI')
                    ->where('oc.eliminado', '=', 'NO')
                    ->orderBy('oc.id')
                    ->groupBy('oc.id', 'oc.nombre')
                    ->get();
                return $datos;
            } else {
                $datos1 =   DB::table('general.permisos_usuario_caja as puc')
                    ->join('configuracion.usuarios as u', 'puc.id_usuario', '=', 'u.id')
                    ->join('general.organicas_cajas as oc', 'puc.id_caja', '=', 'oc.id')
                    ->join('configuracion.rols as r', 'u.id_rol', '=', 'r.id')
                    ->select('oc.id', 'oc.nombre', 'oc.estado')
                    ->where('puc.activo', '=', 'SI')
                    ->where('puc.eliminado', '=', 'NO')
                    ->where('u.id_rol', '=', '2')
                    ->where('u.id', '=', $id_usuario)
                    ->orderBy('oc.id')
                    ->groupBy('oc.id', 'oc.nombre')->get();

                $datos1 =  json_decode($datos1,true);
                if (!empty($datos1)){
                    return $datos1;}
                if (empty($datos1)){
                    $datos2 =   DB::table('general.permisos_usuario_caja as puc')
                        ->join('configuracion.usuarios as u', 'puc.id_usuario', '=', 'u.id')
                        ->join('general.organicas_cajas as oc', 'puc.id_caja', '=', 'oc.id')
                        ->join('configuracion.rols as r', 'u.id_rol', '=', 'r.id')
                        ->select('oc.id', 'oc.nombre','oc.estado')
                        ->where('puc.activo', '=', 'SI')
                        ->where('puc.eliminado', '=', 'NO')
                        ->where('u.id_rol', '=', '9')
                        ->where('u.id', '=', $id_usuario)
                        ->groupBy('oc.id', 'oc.nombre')->get();
                    $datos2 =  json_decode($datos2,true);
                    if (!empty($datos2)){
                    return $datos2;}
                }
                if (empty($datos2)){
                    $datos3 =   DB::table('general.permisos_usuario_caja as puc')
                        ->join('configuracion.usuarios as u', 'puc.id_usuario', '=', 'u.id')
                        ->join('general.organicas_cajas as oc', 'puc.id_caja', '=', 'oc.id')
                        ->join('configuracion.rols as r', 'u.id_rol', '=', 'r.id')
                        ->select('oc.id', 'oc.nombre','oc.estado')
                        ->where('puc.activo', '=', 'SI')
                        ->where('puc.eliminado', '=', 'NO')
                        ->where('u.id_rol', '=', '10')
                        ->where('u.id', '=', $id_usuario)
                        ->groupBy('oc.id', 'oc.nombre')->get();
                    $datos3 =  json_decode($datos3,true);
                    if (!empty($datos3)){
                        return $datos3;}
                }

            }



        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function listar_proceso()
    {
        try {
            $datos =   DB::table('configuracion.anyo_proceso')
                ->select('id as id_proceso', 'anyo as anyo_proceso')
                ->where('activo', '=', 'SI')
                ->where('eliminado', '=', 'NO')->get();

            return $datos;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function crear_cliente($carnet, $nombres, $apellidos, $id_carrera, $id_turno)
    {
        try {
            $resultado = DB::transaction(function () use ($carnet, $nombres, $apellidos, $id_carrera, $id_turno) {
                $datos = [
                    'carnet' => $carnet,
                    'nombres' => $nombres,
                    'apellidos' => $apellidos,
                    'id_carrera_sede' => $id_carrera,
                    'id_turno' => $id_turno,
                    'created_at' => date("Y-m-d H:i:s")
                ];

                $clienteExistente = $this->validar_cliente($carnet);


                if (!$clienteExistente) {
                    $idInsertado = DB::table('general.clientes')->insertGetId($datos);

                    $dato = $this->obtener_cliente($idInsertado);

                    $dato = json_decode($dato, true);


                    return $dato;
                } else {
                    $dato = ['mensaje' => 'el ciente que intenta ingresar ya existe'];
                    return $dato;
                }
            });

            return $resultado;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function obtener_cliente($id_cliente)
    {
        try {
            $datos =   DB::table('general.clientes as c')
                ->join('general.carrera_sede as cs', 'c.id_carrera_sede', '=', 'cs.id')
                ->join('general.carreras as ca', 'cs.id_carrera', '=', 'ca.id')
                ->leftJoin('general.sedes as s', 'cs.id_sede', '=', 's.id')
                ->leftJoin('general.subsedes as su', 'cs.id_subsedes', '=', 'su.id')
                ->select('c.carnet', 'c.nombres', 'c.apellidos', 'c.id', 'cs.id as id_carrera', 'ca.nombre as carrera', 's.nombre as sedes', 'su.nombre as subsede', 'ca.id_facultad', 'c.id_turno')
                ->where('c.activo', '=', 'SI')
                ->where('c.eliminado', '=', 'NO')
                ->where('c.id', '=', $id_cliente)->get();

            return $datos;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function validar_cliente($carnet)
    {
        try {
            $datos =   DB::table('general.clientes as c')
                ->join('general.carrera_sede as cs', 'c.id_carrera_sede', '=', 'cs.id')
                ->join('general.carreras as ca', 'cs.id_carrera', '=', 'ca.id')
                ->leftJoin('general.sedes as s', 'cs.id_sede', '=', 's.id')
                ->leftJoin('general.subsedes as su', 'cs.id_subsedes', '=', 'su.id')
                ->select(DB::raw("CONCAT(c.nombres,' ', c.apellidos) as nombre_completo"), 'c.id', 'ca.nombre as carrera', 's.nombre as sedes', 'su.nombre as subsede', 'ca.id_facultad', 'c.id_turno')
                ->where('c.activo', '=', 'SI')
                ->where('c.eliminado', '=', 'NO')
                ->where('c.carnet', '=', $carnet)->first();


            return $datos;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function listar_carrera_sede($id_caja)
    {
        try {
            $sedes = $this->obtener_sedeosubsede($id_caja);

            if (!empty($sedes[0]->id_sede)) {
                $datos =   DB::table('general.carrera_sede as cs')
                    ->join('general.sedes as s', 'cs.id_sede', '=', 's.id')
                    ->join('general.carreras as c', 'cs.id_carrera', '=', 'c.id')
                    ->select('cs.id', 'c.nombre')
                    ->where('cs.activo', '=', 'SI')
                    ->where('cs.eliminado', '=', 'NO')
                    ->where('s.id', '=', $sedes[0]->id_sede)->get();

                return $datos;
            } else {
                $datos =   DB::table('general.carrera_sede as cs')
                    ->join('general.subsedes as s', 'cs.id_subsedes', '=', 's.id')
                    ->join('general.carreras as c', 'cs.id_carrera', '=', 'c.id')
                    ->select('cs.id', 'c.nombre')
                    ->where('cs.activo', '=', 'SI')
                    ->where('cs.eliminado', '=', 'NO')
                    ->where('s.id', '=', $sedes[0]->id_subsedes)->get();

                return $datos;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function obtener_sedeosubsede($id_caja)
    {
        try {
            $datos =   DB::table('general.caja_sede as cs')
                ->join('general.organicas_cajas as oc', 'cs.id_caja', '=', 'oc.id')
                ->select('cs.id_sede', 'cs.id_subsedes')
                ->where('cs.activo', '=', 'SI')
                ->where('cs.eliminado', '=', 'NO')
                ->where('oc.id', '=', $id_caja)->get();


            return $datos;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function busqueda_cliente($carnet)
    {
        try {
            $datos =   DB::table('general.clientes as c')
                ->join('general.carrera_sede as cs', 'c.id_carrera_sede', '=', 'cs.id')
                ->join('general.carreras as ca', 'cs.id_carrera', '=', 'ca.id')
                ->leftJoin('general.sedes as s', 'cs.id_sede', '=', 's.id')
                ->leftJoin('general.subsedes as su', 'cs.id_subsedes', '=', 'su.id')
                ->select('c.nombres', 'c.apellidos', 'c.carnet as carnet', 'c.id', 'cs.id as id_carrera', 'ca.nombre as carrera', 's.nombre as sedes', 'su.nombre as subsede', 'ca.id_facultad', 'c.id_turno')
                ->where('c.activo', '=', 'SI')
                ->where('c.eliminado', '=', 'NO')
                ->where(function ($query) use ($carnet) {
                    $query->where('c.carnet', 'ilike', "%$carnet")
                        ->orWhere('c.apellidos', 'ilike', "%$carnet");
                })
                ->get();

            return $datos;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }


    public function crear_recibo($id_cliente, $id_tipo_moneda, $id_caja, $id_usuario, $monto, $id_forma_pago, $numero_forma_pago, $datos_detalle)
    {
        $ultimo_recibo = $this->obtener_ultimo_recibos($id_caja);

        try {
            $resultado =    DB::transaction(function () use ($id_cliente, $id_tipo_moneda, $id_caja, $id_usuario, $monto, $ultimo_recibo, $id_forma_pago, $numero_forma_pago, $datos_detalle) {
                $nunero_recibos = $ultimo_recibo + 1;
                $datos = [
                    'id_cliente' => $id_cliente,
                    'id_tipo_moneda' => $id_tipo_moneda,
                    'id_caja' => $id_caja,
                    'id_usuario' => $id_usuario,
                    'monto' => $monto,
                    'numero_recibo' => $nunero_recibos,
                    'anyo' => date('Y'),
                    'id_forma_pago' => $id_forma_pago,
                    'numero_forma_pago' => $numero_forma_pago,
                    'created_at' => date("Y-m-d H:i:s")
                ];

                $idInsertado = DB::table('tesoreria.recibos')->insertGetId($datos);

                foreach ($datos_detalle as $item) {
                    $tipos_pagos[] = [
                        'id_recibos' => $idInsertado,
                        'id_mes' => isset($item['id_mes']) ? $item['id_mes'] : null,
                        'id_tipo_pagp' => $item['id_pago'],
                        'created_at' => date("Y-m-d H:i:s")
                    ];
                }

                DB::table('tesoreria.recibos_detalle')->insert($tipos_pagos);

                return $idInsertado;
            });

            return $resultado;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function crear_recibo_imprecion($id_recibo)
    {
        try {
            $resultado =   DB::transaction(function () use ($id_recibo) {
                $datos = [
                    'id_recibos' => $id_recibo,
                    'created_at' => date("Y-m-d H:i:s")
                ];

                $idInsertado = DB::table('tesoreria.recibos_impresion')->insertGetId($datos);

                return $idInsertado;
            });

            return $resultado;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function obtener_ultimo_recibos($id_caja)
    {
        $datos =   DB::table('tesoreria.recibos as r')
            ->where('r.activo', '=', 'SI')
            ->where('r.eliminado', '=', 'NO')
            ->where('r.id_caja', '=', $id_caja)->count();

        return $datos;
    }

    public function numero_recibos($id_caja)
    {
        $ultimo_recibo = $this->obtener_ultimo_recibos($id_caja);
        $nunero_recibos = $ultimo_recibo + 1;

        return $nunero_recibos;
    }



    public function obtener_tipo_moneda()
    {
        $datos =   DB::table('general.tipo_moneda as tm')
            ->where('tm.activo', '=', 'SI')
            ->where('tm.eliminado', '=', 'NO')
            ->select('tm.id as id_tipo_moneda', 'tm.nombre as tipo_moneda')->orderBy('tm.id', 'desc') // Orden descendente
            ->get();

        return $datos;
    }


    public function obtener_tipo_aracel($id_carrera, $id_facultad, $id_turno)
    {
        $datos =   DB::table('general.tipopago as tp')
            ->leftJoin('general.tipo_pago_facultad as tpf', 'tpf.id_tipopago', '=', 'tp.id')
            ->where('tp.activo', '=', 'SI')
            ->where('tp.eliminado', '=', 'NO')
            ->where('tpf.id_facultad', '=', $id_facultad)
            ->select('tp.id as id_pago', 'tp.nombre as tipo_pago', 'tpf.monto')->get();


        $datos2 =   DB::table('general.tipopago as tp')
            ->leftJoin('general.tipo_aranceles_carrera as tac', 'tac.id_tipopago', '=', 'tp.id')
            ->where('tac.id_carrera_se', '=', $id_carrera)
            ->where('tac.id_truno', '=', $id_turno)
            ->select('tp.id as id_pago', 'tp.nombre as tipo_pago', 'tac.anyo', 'tac.anyo as año_de_pago', 'tac.monto')->get();

        $datos = json_decode($datos, true);
        $datos2 = json_decode($datos2, true);



        $datos = array_merge($datos, $datos2);


        return $datos;
    }



    public function crear_recibos_anulado($id_recibo, $id_usuario, $observacion)
    {
        try {
            $resultado =     DB::transaction(function () use ($id_recibo, $id_usuario, $observacion) {
                $datos = [
                    'id_recibos' => $id_recibo,
                    'id_usuario' => $id_usuario,
                    'observacion' => $observacion,
                    'created_at' => date("Y-m-d H:i:s")
                ];

                $idInsertado = DB::table('tesoreria.recibos_anulados')->insertGetId($datos);

                return $idInsertado;
            });

            return $resultado;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }


    public function ver_recibos($id_recibos)
    {
        try {

            $datos =  DB::table('tesoreria.recibos_detalle as rd')
                ->join('tesoreria.recibos as r', 'rd.id_recibos', '=', 'r.id')
                ->join('general.tipopago as tp', 'rd.id_tipo_pagp', '=', 'tp.id')
                ->join('general.clientes as c', 'r.id_cliente', '=', 'c.id')
                ->join('general.carrera_sede as cas', 'c.id_carrera_sede', '=', 'cas.id')
                ->join('general.carreras as ca', 'ca.id', '=', 'cas.id_carrera')
                ->join('general.organicas_cajas as oc', 'r.id_caja', '=', 'oc.id')
                ->join('general.caja_sede as cs', 'cs.id_caja', '=', 'oc.id')
                ->join('general.tipo_moneda as tm', 'r.id_tipo_moneda', '=', 'tm.id')
                ->join('configuracion.usuarios as u', 'r.id_usuario', '=', 'u.id')
                ->join('general.forma_pago as fg', 'r.id_forma_pago', '=', 'fg.id')
                ->join('general.turno as tu', 'c.id_turno', '=', 'tu.id')
                ->leftJoin('general.meses as m', 'rd.id_mes', '=', 'm.id')
                ->leftJoin('general.sedes as s', 'cs.id_sede', '=', 's.id')
                ->leftJoin('general.subsedes as subs', 'cs.id_subsedes', '=', 'subs.id')
                ->where('r.id', '=', $id_recibos)
                ->select(
                    'r.id',
                    'r.numero_recibo',
                    'r.monto',
                    'r.numero_forma_pago',
                    'r.created_at as fecha',
                    'r.anyo',
                    'c.nombres',
                    'c.carnet',
                    'c.apellidos',
                    'tm.nombre as moneda',
                    'tp.nombre as tipo_pago',
                    'fg.nombre as forma_pago',
                    'tu.nombre as turno',
                    'c.id_turno',
                    'm.nombre as meses',
                    's.nombre as sedes',
                    'subs.nombre as subsedes',
                    'ca.nombre as carrera'
                )
                ->groupBy(
                    'r.id',
                    'r.numero_recibo',
                    'r.monto',
                    'r.numero_forma_pago',
                    'r.created_at',
                    'r.anyo',
                    'c.nombres',
                    'c.carnet',
                    'c.apellidos',
                    'tm.nombre',
                    'tp.nombre',
                    'fg.nombre',
                    'tu.nombre',
                    'c.id_turno',
                    'm.nombre',
                    's.nombre',
                    'subs.nombre',
                    'ca.nombre'
                )->get();

            $numero_ruc = $this->numero_ruc();
            $datos = json_decode($datos, true);

            $dato = [
                'datos_recibos' => $datos,
                'numero_ruc' => $numero_ruc
            ];
            return $dato;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }


    //->pluck('id');
    public function obtener_id_mes_recibos($id_cliente)
    {
        $datos =   DB::table('tesoreria.recibos as r')
            ->join('tesoreria.recibos_detalle as rd', 'r.id',  '=', 'rd.id_recibos')
            ->where('r.activo', '=', 'SI')
            ->where('r.eliminado', '=', 'NO')
            ->where('r.id_cliente', '=', $id_cliente)
            ->whereNotNull('rd.id_mes')
            ->select('rd.id_mes')
            ->pluck('id_mes');

        return $datos;
    }

    public function obtener_mes_pago($id_cliente)
    {
        $excluir_mes = $this->obtener_id_mes_recibos($id_cliente);

        if (empty($excluir_mes)) {
            $datos =   DB::table('general.meses as m')
                ->where('m.activo', '=', 'SI')
                ->where('m.eliminado', '=', 'NO')
                ->select('m.id', 'm.nombre')
                ->get();
        } else {
            $datos =   DB::table('general.meses as m')
                ->where('m.activo', '=', 'SI')
                ->where('m.eliminado', '=', 'NO')
                ->whereNotIn('m.id', $excluir_mes)
                ->select('m.id', 'm.nombre')
                ->get();
        }


        return $datos;
    }

    public function obtener_arqueo_pendiente($id_usuario)
    {
        $fechaActual = Carbon::now();
        $fechaAnterior = $fechaActual->subDay();
        $id_recibo = DB::table('tesoreria.recibos')->where('created_at', '=', $fechaAnterior)
            ->where('finalizado', '=', 'NO')->where('id_usuario', '=', $id_usuario)->pluck('id');
        return $id_recibo;
    }

    public function tipo_cambio()
    {
        try {
            $datos =  DB::table('general.tipocambio')->where('id', '=', '1')
                ->where('activo', '=', 'SI')
                ->select('monto')->get();

            $datos = json_decode($datos, true);

            return $datos;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }


    public function update_tipo_cambio($monto)
    {
        try {
            $resultado =   DB::transaction(function () use ($monto) {
                DB::table('general.tipocambio')->where('id', '=', '1')
                    ->where('activo', '=', 'SI')
                    ->update(['monto' => $monto]);
            });

            return $resultado;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function forma_pago()
    {
        try {
            $datos =  DB::table('general.forma_pago')
                ->where('activo', '=', 'SI')
                ->where('eliminado', '=', 'NO')
                ->select('id', 'nombre')->get();

            $datos = json_decode($datos, true);

            return $datos;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function numero_ruc()
    {
        try {
            $datos =  DB::table('general.numero_ruc')
                ->where('activo', '=', 'SI')
                ->where('eliminado', '=', 'NO')
                ->select('nombre as numero_ruc')
                ->first();

            return $datos->numero_ruc;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public  function obtener_estadocaja($idcaja)
    {

        try {
            $estado = DB::table('general.organicas_cajas')
                ->where('id', '=', $idcaja)
                ->where('activo', '=', 'SI')
                ->where('eliminado', '=', 'NO')
                ->select('estado as estado_caja')
                ->first();

            return $estado;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
