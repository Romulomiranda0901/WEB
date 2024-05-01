<?php

namespace App\Http\Controllers;

use App\Http\Resources\CordinadorSedeResourse;
use App\Http\Resources\Evaluacion_por_nacionalResource;
use App\Models\coordinadorSede;
use App\Http\Requests\Storecordinador_sedeRequest;
use App\Http\Requests\Updatecordinador_sedeRequest;
use App\Models\Entregable;
use App\Models\Evaluacion_por_nacional;
use Illuminate\Support\Facades\DB;

class CordinadorSedeController extends Controller
{

    public function index()
    {

        return  (CordinadorSedeResourse::collection(
            CoordinadorSede::with([
                "sede",
                "genero",
                "eventoSedeActual",
                "usuario",
                "tipo_cordinadors",
            ])->get()
        ));
    }


    public function create()
    {
        //
    }


    public function store(Storecordinador_sedeRequest $request)
    {
        //
        return  DB::transaction(function()use ($request){
            $cordinador_sede = new CoordinadorSede([
                "sede_id"=> $request->input("sede_id"),
                "cedula"=> $request->input("cedula"),
                "nombres"=> $request->input("nombres"),
                "apellidos"=> $request->input("apellidos"),
                "genero_id"=> $request->input("genero_id"),
                "tipo_cordinadors_id"=> $request->input("tipo_cordinadors_id"),

            ]);

           // $Entregable = Entregable::findOrFail($request->input("entregables")["id"]);

          //  $EvaluacionPorNacional->Entregable()->associate($Entregable);
            $cordinador_sede->save();
            return new CordinadorSedeResourse($cordinador_sede);
        });
    }

    public function show($id)
    {
        //

        return DB::transaction(function () use($id){

            return (new CordinadorSedeResourse( coordinadorSede::findOrFail($id)));

        });
    }


    public function edit(coordinadorSede $cordinador_sede)
    {
        //
    }



    public function update(Updatecordinador_sedeRequest $request,$id)
    {
        return  DB::transaction(function()use ($request, $id){
            $Patrocinador = CoordinadorSede::findOrFail($id);
            $Patrocinador->update($request->all());

            return  (new CoordinadorSede($id))
                ->additional(['msg'=>'Datos Actualizado Correctamente'])
                ->response()
                ->setStatusCode('202');
        });

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\coordinadorSede  $cordinador_sede
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        return  DB::transaction(function()use ($id){
            $participante = CoordinadorSede::findOrFail($id);
            $participante->delete();
            return new CordinadorSedeResourse($participante);
        });
    }
}
