<?php

namespace App\Http\Controllers;

use App\Http\Resources\Evaluacion_por_nacionalResource;
use App\Http\Resources\Evaluacion_por_sedeResource;
use App\Models\Entregable;
use App\Models\Evaluacion_por_nacional;
use App\Models\Evaluacion_por_sede;
use App\Http\Requests\StoreEvaluacion_por_sedeRequest;
use App\Http\Requests\UpdateEvaluacion_por_sedeRequest;
use Illuminate\Support\Facades\DB;

class EvaluacionPorSedeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return  (Evaluacion_por_sedeResource::collection(
            Evaluacion_por_sede::with([
                "Entregable",
            ])->get()
        ));
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEvaluacion_por_sedeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEvaluacion_por_sedeRequest $request)
    {
        //

        return  DB::transaction(function()use ($request){
            $Evaluacion_por_sede = new Evaluacion_por_sede([
                "nota_documento" => $request->input("nota_documento"),
                "nota_video" =>$request->input("nota_video"),
                "nota_final" => $request->input("nota_final"),


            ]);

            $Entregable = Entregable::findOrFail($request->input("entregables")["id"]);

            $Evaluacion_por_sede->Entregable()->associate($Entregable);
            $Evaluacion_por_sede->save();
            return new Evaluacion_por_sedeResource($Evaluacion_por_sede);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evaluacion_por_sede  $evaluacion_por_sede
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluacion_por_sede $evaluacion_por_sede)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evaluacion_por_sede  $evaluacion_por_sede
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluacion_por_sede $evaluacion_por_sede)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEvaluacion_por_sedeRequest  $request
     * @param  \App\Models\Evaluacion_por_sede  $evaluacion_por_sede
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEvaluacion_por_sedeRequest $request, $id)
    {



        return  DB::transaction(function()use ($request, $id){
            $Evaluacion_por_sede = Evaluacion_por_sede::findOrFail($id);
            $Evaluacion_por_sede->nota_documento = $request->input("nota_documento");
            $Evaluacion_por_sede->nota_video = $request->input("nota_video");
            $Evaluacion_por_sede->nota_final = $request->input("nota_final");

          /*  $Entregable = Entregable::findOrFail($request->input("entregables"));
            $Evaluacion_por_sede->Entregable()->associate($Entregable);*/

            $Evaluacion_por_sede->update();
            return new Evaluacion_por_sedeResource($Evaluacion_por_sede);
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evaluacion_por_sede  $evaluacion_por_sede
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return  DB::transaction(function()use ($id){
            $participante = Evaluacion_por_sede::findOrFail($id);
            $participante->delete();
            return new Evaluacion_por_sedeResource($participante);
        });
    }


    public function ganador_sede(){


        $departamentos = DB::table('evaluacion_por_sedes')
            ->join('entregables','entregables.id', '=','evaluacion_por_sedes.entregables_id' )
            ->join('desafios','desafios.id', '=','entregables.desafio_id' )
            ->join('equipos','equipos.id','=','entregables.equipo_id')
            ->join('categorias','categorias.id','=','desafios.categoria_id')
            ->join ('propuestas','propuestas.id','=','categorias.categoria_id')
            ->join('evento_sedes','evento_sedes.id', '=','equipos.sede_id' )
            ->join ('sedes','sedes.id','=','evento_sedes.sede_id')
            ->where('evaluacion_por_sedes.nota_final','=','(select max(evaluacion_por_sedes.nota_final) from evaluacion_por_sedes)')
            ->select('equipos.nombre as equipo , entregables.nombre as entregable , sedes.nombre as sede  ,evaluacion_por_sedes.nota_final as nota_final')
            ->orderBy('1,2,3,4')
            ->get();

        return response()->json([
            "data" => $departamentos
        ]);

    }

    public function  listar_equipo()
    {
        $equipo = DB::table('evaluacion_por_sedes')
        ->join('entregables', 'entregables.id', '=','evaluacion_por_sedes.entregables_id')
            ->join('equipos', 'equipos.id', '=','entregables.equipo_id')
            ->join('desafios', 'desafios.id', '=', 'entregables.desafio_id')
            ->join('criterios', 'criterios.id', '=', 'entregables.criterio_id')
            ->join('sedes', 'sedes.id', '=', 'equipos.sede_id')
            ->where('evaluacion_por_sedes.anyo', '=',date("Y"))
            ->select('equipos.id as id_equipo', 'equipos.nombre as nombre_equipo','sedes.id as sede_id','sedes.nombre as nombre_sedes'
            , 'desafios.id as desafio_id','desafios.nombre as nombre_desafio','entregables.id as entregable_id','entregables.nombre as archivo_pdf',
                'entregables.link as link', 'criterios.id as criterios_id','criterios.nombre as criterio_nombre','evaluacion_por_sedes.id',
            'evaluacion_por_sedes.nota_documento as nota_documento','evaluacion_por_sedes.nota_video as nota_video',
                'evaluacion_por_sedes.nota_final as nota_final','evaluacion_por_sedes.anyo as anyo')
            ->orderBy('sedes.nombre')
            ->get();
        return response()->json([
            "data" => $equipo
        ]);

    }

    public function buscar_equipo($id_equipo)
    {
        $equipo = DB::table('entregables')
            ->join('equipos','equipos.id', '=', 'entregables.equipo_id')
            ->where('equipos.id', '=', $id_equipo)
            ->select('equipos.id as equipo_id','equipos.nombre as nombre_equipo','entregables.id as entregables_id',
                        'entregables.nombre as entregables_nombre','entregables.link as link'
            )->get();

        return response()->json(
            [
                "data" =>$equipo
            ]);

    }

    public function listar_equipos_emtregable()
    {
        $Year = date("Y");
        $equipo = DB::table('equipos')
            ->join('desafios','desafios.id', '=', 'equipos.desafio_id')
            ->join('categorias','categorias.id' ,'=', 'equipos.desafio_id')
            ->join('entregables','entregables.equipo_id', '=','equipos.id')
            ->join('sedes', 'sedes.id', '=', 'equipos.sede_id')
            ->where( 'equipos.anyo', '=',$Year)
            ->select('equipos.id as id_equipo', 'equipos.coordinador_id as coordinador', 'equipos.nombre as nombre_equipo', 'equipos.anyo as anyo',
                'desafios.id as id_desafio', 'desafios.nombre as nombre_desafio', 'categorias.id as id_categoria',
                'categorias.nombre as categoria',
                'entregables.id as id_entregable', 'entregables.nombre as archivo_pdf', 'entregables.link as link',
                'sedes.id as id_sede','sedes.nombre as nombre_sede'
            )->get();
         return response([
             "data" => $equipo
         ]);



    }

    public function obtener_ganadores()
    {


        $Year = date("Y");
        $ganadores = DB::table('evaluacion_por_sedes')
            ->join('entregables','entregables.id', '=','evaluacion_por_sedes.entregables_id' )
            ->join('desafios','desafios.id', '=','entregables.desafio_id')
            ->join('criterios','criterios.id','=','entregables.criterio_id')
            ->join('equipos','equipos.id','=','entregables.equipo_id')
            ->join('sedes','sedes.id', '=','equipos.sede_id')
            ->whereIn('evaluacion_por_sedes.nota_final',function ($query){
                $query->selectRaw('max(evaluacion_por_sedes.nota_final) as nota_ganadora')
                    ->from('evaluacion_por_sedes')
                    ->join('entregables','entregables.id','=','evaluacion_por_sedes.entregables_id')
                    ->join('criterios','criterios.id','=','entregables.criterio_id')
                    ->join('equipos','equipos.id','=','entregables.equipo_id')
                    ->join('sedes','sedes.id', '=','equipos.sede_id')
                    ->groupBy('entregables.criterio_id');
            })
            ->where( 'equipos.anyo', '=',$Year)
            ->select('evaluacion_por_sedes.id as id','sedes.id as id_sede','sedes.nombre as sede',
                        'equipos.id as id_equipo','equipos.nombre as equipo','entregables.id as entregable_id','entregables.nombre as entregable',
                        'criterios.id as id_criterio','criterios.nombre as criterio','evaluacion_por_sedes.nota_final as nota_final','desafios.id as desafio_id','desafios.nombre as desafio'
                    )
            ->orderBy('sede' )
            ->get();
        return response()->json([
            "data" => $ganadores
        ]);

    }

    public function subconsulta()
    {
        $subconsulta =  DB::table('evaluacion_por_sedes')
            ->join('entregables','entregables.id','=','evaluacion_por_sedes.entregables_id')
            ->join('criterios','criterios.id','=','entregables.criterio_id')
            ->join('equipos','equipos.id','=','entregables.equipo_id')
            ->join('sedes','sedes.id', '=','equipos.sede_id')
            ->selectRaw('max(evaluacion_por_sedes.nota_final) as nota_ganadora')
            ->groupBy('entregables.criterio_id')
            ->get();


        return ['nota'=>$subconsulta];



    }
}
