<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class reporte_estado_cuenta_estudiante extends Model
{
    public function estado_cuenta_estudiante ($id_cliente,$id_turno){
        $year = Carbon::now()->year;

       $datos = DB::table('tesoreria.recibos as r')
            ->join('tesoreria.recibos_detalle as  rd','rd.id_recibos','=','r.id')
            ->leftJoin('tesoreria.recibos_anulados ra','ra.id_recibos','=','r.id')
            ->join('general.meses as m','rd.id_mes','=','m.id')
            ->join('general.clientes as c','r.id_cliente','=',' c.id')
            ->where('c.id','=',$id_cliente)
            ->where('c.id_turno','=',$id_turno)
            ->where('r.anyo','=',$year)
            ->where('r.activo','=','SI')
            ->where('r.eliminado','=','NO')
            ->whereNull('ra.id')
            ->select('m.nombre as mes','r.numero_recibo','r.monto')->get();

       $datos = json_decode($datos,true);
       return $datos;
    }
}
