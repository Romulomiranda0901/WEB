<?php

namespace App\Http\Controllers;

use App\Models\Entregable;
use App\Models\Evaluacion_por_nacional;
use App\Http\Requests\StoreEvaluacion_por_nacionalRequest;
use App\Http\Requests\UpdateEvaluacion_por_nacionalRequest;
use App\Http\Resources\Evaluacion_por_nacionalResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EvaluacionPorNacionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return  (Evaluacion_por_nacionalResource::collection(
            Evaluacion_por_nacional::with([
                "Entregable",
            ])->get()
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEvaluacion_por_nacionalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEvaluacion_por_nacionalRequest $request)
    {
        //
        return  DB::transaction(function()use ($request){

            $datos = $request->all();


            foreach ($datos as $entregable_ganadores) {

                $entregable =$this->validar_entregable( $entregable_ganadores['entregable']);

                if($entregable === null)
                {
                    $EvaluacionPorNacional = new Evaluacion_por_nacional([
                        'entregables_id' => $entregable_ganadores['entregable'],
                        'nota_documento' => 0,
                        'nota_video' => 0,
                        'nota_final' => 0,
                        'descripcion' => 'Pediente',
                        'anyo' => date("Y")
                    ]);


                    //queda pediente la validacion

                    $Entregable = Entregable::findOrFail($entregable_ganadores['entregable']);
                    $EvaluacionPorNacional->Entregable()->associate($Entregable);
                    $EvaluacionPorNacional->save();
                }

                else{
                    return ['msg'=>'Estos equipo ya esta registardo para Nacional'];
                }


              //
            }
            return[
                'datos' =>new Evaluacion_por_nacionalResource($EvaluacionPorNacional),
                'msg' =>'Datos Guardado Correctamente'
                ];


        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evaluacion_por_nacional  $evaluacion_por_nacional
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluacion_por_nacional $evaluacion_por_nacional)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evaluacion_por_nacional  $evaluacion_por_nacional
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluacion_por_nacional $evaluacion_por_nacional)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEvaluacion_por_nacionalRequest  $request
     * @param  \App\Models\Evaluacion_por_nacional  $evaluacion_por_nacional
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEvaluacion_por_nacionalRequest $request, $id)
    {
        //


        return  DB::transaction(function()use ($request, $id){
            $EvaluacionPorNacional = Evaluacion_por_nacional::findOrFail($id);
            $EvaluacionPorNacional->nota_documento = $request->input("nota_documento");
            $EvaluacionPorNacional->nota_video = $request->input("nota_video");
            $EvaluacionPorNacional->nota_final = $request->input("nota_final");
            //$Entregable = Entregable::findOrFail($request->input("entregables"));
            //$EvaluacionPorNacional->Entregable()->associate($Entregable);

            $EvaluacionPorNacional->update();
            return new Evaluacion_por_nacionalResource($EvaluacionPorNacional);
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evaluacion_por_nacional  $evaluacion_por_nacional
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return  DB::transaction(function()use ($id){
            $participante = Evaluacion_por_nacional::findOrFail($id);
            $participante->delete();
            return new Evaluacion_por_nacionalResource($participante);
        });
    }

    public function ganador_nac(){

        $departamentos = DB::table('evaluacion_por_nacionals')
            ->join('entregables','entregables.id', '=','evaluacion_por_nacionals.entregables_id' )
            ->join('desafios','desafios.id', '=','entregables.desafio_id' )
            ->join('equipos','equipos.id','=','entregables.equipo_id')
            ->join('categorias','categorias.id','=','desafios.categoria_id')
            ->join ('propuestas','propuestas.id','=','categorias.categoria_id')
            ->join('evento_sedes','evento_sedes.id', '=','equipos.sede_id' )
            ->join ('sedes','sedes.id','=','evento_sedes.sede_id')
            ->where('evaluacion_por_nacionals.nota_final','=','(select max(evaluacion_por_nacionals.nota_final) from evaluacion_por_nacionals)')
            ->select('equipos.nombre as equipo , entregables.nombre as entregable , sedes.nombre as sede  ,evaluacion_por_nacionals.nota_final as nota_final')
            ->orderBy('1,2,3,4')
            ->get();

        return response()->json([
            "data" => $departamentos
        ]);
    }

    public function  listar_equipo_nacional()
    {


        $equipo = DB::table('evaluacion_por_nacionals')
            ->join('entregables','evaluacion_por_nacionals.entregables_id','=','entregables.id')
            ->join('criterios','criterios.id', '=', 'entregables.criterio_id')
            ->join('desafios','entregables.desafio_id', '=', 'desafios.id')
            ->join('equipos','entregables.equipo_id', '=', 'equipos.id')
            ->join('sedes','equipos.sede_id', '=', 'sedes.id')
            ->where('evaluacion_por_nacionals.anyo', '=',date("Y"))
            ->select(
                'evaluacion_por_nacionals.id as id',  'evaluacion_por_nacionals.nota_final as nota_final','evaluacion_por_nacionals.entregables_id as entregable_id',
                'evaluacion_por_nacionals.nota_documento as nota_documento', 'evaluacion_por_nacionals.nota_video as nota_video',
                        'entregables.nombre as archivo_pdf', 'entregables.link as link',
                        'entregables.criterio_id as criterios_id', 'criterios.nombre as criterio_nombre',
                        'entregables.desafio_id as desafio_id', 'desafios.nombre as nombre_desafio',
                        'entregables.equipo_id as id_equipo', 'equipos.nombre as nombre_equipo',
                        'equipos.sede_id as sede_id', 'sedes.nombre as nombre_sedes'
            ) ->orderBy('sedes.nombre')
            ->get();

        return response()->json([
            "data" => $equipo
        ]);

    }

    public function validar_entregable($id_entregable)
    {
        $entregable = Evaluacion_por_nacional::where('entregables_id', '=',$id_entregable)->first();

        return $entregable;
    }

    public function obtener_ganadores_nacional()
    {


        $Year = date("Y");
        $ganadores = DB::table('evaluacion_por_nacionals')
            ->join('entregables','entregables.id', '=','evaluacion_por_nacionals.entregables_id' )
            ->join('desafios','desafios.id', '=','entregables.desafio_id')
            ->join('criterios','criterios.id','=','entregables.criterio_id')
            ->join('equipos','equipos.id','=','entregables.equipo_id')
            ->join('sedes','sedes.id', '=','equipos.sede_id')
            ->whereIn('evaluacion_por_nacionals.nota_final',function ($query){
                $query->selectRaw('max(evaluacion_por_nacionals.nota_final) as nota_ganadora')
                    ->from('evaluacion_por_nacionals')
                    ->join('entregables','entregables.id','=','evaluacion_por_nacionals.entregables_id')
                    ->join('criterios','criterios.id','=','entregables.criterio_id')
                    ->join('equipos','equipos.id','=','entregables.equipo_id')
                    ->join('sedes','sedes.id', '=','equipos.sede_id')
                    ->groupBy('entregables.criterio_id');
            })
            ->where( 'equipos.anyo', '=',$Year)
            ->select('evaluacion_por_nacionals.id as id','sedes.id as id_sede','sedes.nombre as sede',
                'equipos.id as id_equipo','equipos.nombre as equipo','entregables.id as entregable_id','entregables.nombre as entregable',
                'criterios.id as id_criterio','criterios.nombre as criterio','evaluacion_por_nacionals.nota_final as nota_final','desafios.id as desafio_id','desafios.nombre as desafio'
            )
            ->orderBy('sede' )
            ->get();
        return response()->json([
            "data" => $ganadores
        ]);

    }


}
