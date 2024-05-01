<?php

namespace App\Http\Controllers;

use App\Http\Resources\DesafioResource;
use App\Http\Resources\EntregableResource;
use App\Models\Desafio;
use App\Models\Entregable;
use App\Http\Requests\StoreEntregableRequest;
use App\Http\Requests\UpdateEntregableRequest;
use App\Models\Equipo;
use App\Models\Evaluacion_por_sede;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EntregableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return  (DesafioResource::collection(
            Entregable::with([
                "desafio",
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
     * @param  \App\Http\Requests\StoreDesafioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEntregableRequest $request)
    {
        $equipo = Equipo::find($request->input("equipo_id"));

        $nombre_equipo = $equipo->nombre;

        $ruta = public_path('Entregable/'.$nombre_equipo);

        //isDirectory () tomará un argumento como ruta de carpeta y devolverá true si la carpeta existe o false.
       if(!File::isDirectory($ruta)){
            //makeDirectory () tomará cuatro argumentos para crear una carpeta con permiso
            File::makeDirectory($ruta, 0777, true, true);
        }else{
            var_dump('Directorio Exite');
        }

        if($request->hasFile("urlpdf")) {
            $file = $request->file("urlpdf");
            if ($file->guessExtension() == "pdf") {
                $archivo = $file->getClientOriginalName();
                $separador = ".";
                $separada = explode($separador, $archivo);
                $fechaActual = date('d-m-Y_H_i_s');
                $nombre = $separada[0] . '_' . $fechaActual . "." . $file->getClientOriginalExtension();
                $ruta2 = public_path("Entregable" . "\\".$nombre_equipo ."\\" . $nombre);
                $ruta3="/".$nombre_equipo."/".$nombre;
                copy($file, $ruta2);
            }
            else{
             dd('No es Un archivo pdf');
            }
        }
        else{
            dd("archivo incorrecto");
        }
        return DB::transaction(function () use($request,$ruta3,$archivo){


            $archivos = new Entregable([
                "desafio_id" => $request->input("desafio_id"),
                "criterio_id" => $request->input("criterio_id"),
                "equipo_id" =>$request->input("equipo_id"),
                "tipo_archivo_id" => $request->input('tipo_archivo_id'),
                "nombre" => $ruta3,
                "descripcion" => $archivo,
                "link" =>  $request->input("link"),
            ]);

            $archivos->save();

            $evalucion = new Evaluacion_por_sede([
                'entregables_id' => $archivos->id,
                'nota_documento' => 0,
                'nota_video' => 0,
                'nota_final' => 0,
                'descripcion' => 'nada',
                'anyo' => date("Y")
            ]);

            $evalucion->save();
            return new EntregableResource($archivos);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entregable  $entregable
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new DesafioResource(
            Entregable::with([
                "desafio",
            ])->findOrFail($id)
        );
    }

    /**re
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entregable  $entregable
     * @return \Illuminate\Http\Response
     */
    public function edit(Entregable $entregable)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEntregableRequest  $request
     * @param  \App\Models\Entregable  $entregable
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEntregableRequest $request, $id)
    {
       /* return DB::transaction(function () use ($request,$id) {

            $equipo = Entregable::findOrFail($id);
            $equipo->update($request->all());

            return  (new Entregable($id))
                ->additional(['msg'=>'Datos Actualizado Correctamente'])
                ->response()
                ->setStatusCode('202');
        });*/


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entregable  $entregable
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $equipo = Entregable::findOrFail($id);
            $equipo->delete();
            return response()->json(["state" => true]);
        });
    }
}
