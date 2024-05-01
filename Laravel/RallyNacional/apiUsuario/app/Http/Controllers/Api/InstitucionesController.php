<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActualizarInstitucionesResquest;
use App\Http\Resources\InstitucionesResource;
use App\Http\Requests\InstitucionesResquest;
use App\Models\Equipo;
use Illuminate\Http\Request;
use App\Models\Institucion;
use Illuminate\Support\Facades\DB;


class InstitucionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return InstitucionesResource::collection(Institucion::orderBy('id')->get());
        }
        catch (\Exception $ex)
        {
            return $ex->getMessage();
        }

        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $institucion = new Institucion();
        $institucion->nombre = $request->nombre;
        $institucion->abreviacion = $request->abreviacion;

        return (new InstitucionesResource( Institucion::create($request->all())))
            ->additional(['msg'=>'Datos Guardo Correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Institucion $institucion)
    {
        //
        return new InstitucionesResource($institucion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Institucion $institucion)
    {

        $institucion->update($request->all());


         return response()->json([
             'data' => $institucion,
             'respuesta' => true,
             'mensaje' => "Datos Actualizado Correctamente"
         ],200);

        /*return  (new InstitucionesResource($institucion))
            ->additional(['msg'=>'Datos Actualizado Correctamente'])
            ->response()
            ->setStatusCode('202');*/


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        return DB::transaction(function () use ($id) {
            $institucion =Institucion::findOrFail($id);
            $institucion->delete();
            return response()->json(["state" => true]);
        });
    }
}
