<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class reporte_estado_cuenta_estudiante_carrera extends Model
{

    public function listado_sede(){
        try {

          $datos =  DB::table('general.sedes')
                ->where('activo','=','SI')
                ->where('eliminado','=','NO')
                ->select('id','nombre')->get();
          $datos = json_decode($datos,true);

          return $datos;


        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function listado_subsedes(){
        try {
            $datos =  DB::table('general.subsedes')
                ->where('activo','=','SI')
                ->where('eliminado','=','NO')
                ->select('id','nombre')->get();
            $datos = json_decode($datos,true);

            return $datos;

        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function listar_carrera_sede($id_sede , $id_subsede){
        try {


            if (!empty($id_sede)){
                $datos =   DB::table('general.carrera_sede as cs')
                    ->join('general.sedes as s','cs.id_sede','=','s.id')
                    ->join('general.carreras as c','cs.id_carrera','=','c.id')
                    ->select('cs.id','c.nombre')
                    ->where('cs.activo','=','SI')
                    ->where('cs.eliminado','=','NO')
                    ->where('s.id','=',$id_sede)->get();

                $datos = json_decode($datos,true);

                return $datos;
            }else{
                $datos =   DB::table('general.carrera_sede as cs')
                    ->join('general.subsedes as s','cs.id_subsedes','=','s.id')
                    ->join('general.carrera as c','cs.id_carrera','=','c.id')
                    ->select('cs.id','c.nombre')
                    ->where('cs.activo','=','SI')
                    ->where('cs.eliminado','=','NO')
                    ->where('s.id','=',$id_subsede)->get();
                $datos = json_decode($datos,true);

                return $datos;
            }

        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }


    public function turno(){
        try {

            $datos =  DB::table('general.turno')
                ->where('activo','=','SI')
                ->where('eliminado','=','NO')
                ->select('id','nombre')->get();
            $datos = json_decode($datos,true);

            return $datos;


        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function listado_estado_cuenta_estudiante_carrera($id_carrera,$id_turno){
        try {

            $year = Carbon::now()->year;

            $datos = DB::table('tesoreria.recibos as r')
                ->join('tesoreria.recibos_detalle as  rd','rd.id_recibos','=','r.id')
                ->leftJoin('tesoreria.recibos_anulados ra','ra.id_recibos','=','r.id')
                ->join('general.meses as m','rd.id_mes','=','m.id')
                ->join('general.clientes as c','r.id_cliente','=',' c.id')
                ->where('c.id_carrera_sede','=',$id_carrera)
                ->where('c.id_turno','=',$id_turno)
                ->where('r.anyo','=',$year)
                ->where('r.activo','=','SI')
                ->where('r.eliminado','=','NO')
                ->whereNull('ra.id')
                ->select(DB::raw("CONCAT(c.nombres,' ', c.apellidos) as nombre_completo"),'c.id','m.nombre as mes','r.numero_recibo','r.monto')->get();

            $datos = json_decode($datos,true);
            return $datos;



        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
}
