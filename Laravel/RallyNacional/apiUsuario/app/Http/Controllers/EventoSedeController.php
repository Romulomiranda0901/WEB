<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventoSedeRequest;
use App\Http\Resources\EventoSedeResource;
use App\Models\Evento;
use App\Models\EventoSede;
use App\Models\Sede;
use Illuminate\Support\Facades\DB;

class EventoSedeController extends Controller
{

    protected $evento;

    public function __construct()
    {
        $this->evento = Evento::actual();
    }

    public function crear(EventoSedeRequest $request)
    {
        $datos = $this->Verificar_inscripcta($request->sede_id,date("Y"));

       if(empty($datos))
       {
           return DB::transaction(function()use ($request){

               $eventoSede = new EventoSede();
               $eventoSede->sede_id = $request->sede_id;
               $eventoSede->evento_id = $request->evento_id;
               $eventoSede->coordinador_id = $request->coordinador_id;
               $eventoSede->max_participacion =$request->max_participacion;
               $eventoSede->anyo =date("Y");


               $eventoSede->save();

               return response()->json([
                   'data' =>$eventoSede,
                   'res' => true,
                   'msg' => 'Datos Registrado Correctamente'
               ], 200);

           });
       }
       else
       {
           return response()->json([
               'res' => false,
               'msg' => 'Esta sede ya esta registrada para el evento del año presente'
           ], 200);
       }



    }

    public function eliminar($id)
    {
        return DB::transaction(function()use ($id){
            $eventoSede = EventoSede::findOrFail($id);
            $eventoSede->delete();
            return new EventoSedeResource($eventoSede);
        });
    }

    public function editar(EventoSedeRequest $request, $id)
    {
        return DB::transaction(function()use ($request, $id){
            $eventoSede = EventoSede::findOrFail($id);
            $eventoSede->update($request->all());
            return new EventoSedeResource($eventoSede);
        });
    }

    public function equipos($id){
        $equipos =  EventoSede::with([
            'equipos'
        ])->findOrFail($id)
        ->getRelation("equipos");

        return new EventoSedeResource($equipos);
    }

    public function sede_eventosede(){
        $sedes = Sede::with([
                'institucion',
                'eventosede'
            ]
        )->get();

        foreach ($sedes as  &$sede){

            $eventosede = $sede->eventosede()->first();
            $evento = $eventosede->evento()->first();
            $cordinador = $eventosede->coordinador()->first();
            $sede["evento"] = $evento;
            $sede["cordinador"] = $cordinador;
        }

        return response()->json([
            'data' => $sedes
        ]);
    }

    public function Verificar_inscripcta($id_sede, $anyo)
    {
        $sede =  DB::table('evento_sedes')
            ->join('sedes','sedes.id', '=', 'evento_sedes.sede_id')
            ->where('evento_sedes.sede_id', '=',$id_sede )
            ->where('evento_sedes.anyo', '=',$anyo)
            ->select('evento_sedes.sede_id', 'sedes.nombre','evento_sedes.anyo')
            ->get()
            ->all();

       return $sede;


    }
}
