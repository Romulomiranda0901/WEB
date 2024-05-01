<?php

namespace App\Http\Controllers;

use App\Http\Resources\TipoCordinadorResource;
use App\Models\tipo_cordinador;
use App\Http\Requests\Storetipo_cordinadorRequest;
use App\Http\Requests\Updatetipo_cordinadorRequest;
use Illuminate\Support\Facades\DB;

class TipoCordinadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TipoCordinadorResource::collection(
            tipo_cordinador::where('tipo','=','Coordinador')->get()
        );
    }
     public function CoordinadorTipo()
     {
         $coordinador = DB::table('coordinador_sedes')
             ->join('tipo_cordinadors','tipo_cordinadors.id', '=','coordinador_sedes.tipo_cordinadors_id' )
             ->where('tipo_cordinadors.tipo','=','Coordinador')
             ->select('coordinador_sedes.id','coordinador_sedes.nombres','coordinador_sedes.apellidos')
             ->get();

         return response()->json([
             "data" => $coordinador
         ]);
     }
}
