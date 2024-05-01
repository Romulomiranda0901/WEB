<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArchivosGeneralResource;
use App\Http\Resources\DesafioResource;
use App\Http\Requests\StoreArchivoGeneralRequest;
use App\Http\Requests\UpdateArchivoGeneralRequest;
use App\Models\ArchivoGeneral;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facade\File;
use function Faker\Provider\pt_BR\check_digit;

class ArchivoGeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return  (ArchivosGeneralResource::collection(
            ArchivoGeneral::with([
                "evento",
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
     * @param  \App\Http\Requests\StoreArchivoGeneralRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArchivoGeneralRequest $request)
    {

        $files=$request->file();
        $tamaño= sizeof($files);


        for ($i = 1 ; $i<=$tamaño ; $i++){

            if($request->hasFile("urlpdf".$i)){
                $file=$request->file("urlpdf".$i);
                if($file->guessExtension()=="pdf"){
                    $archivo =  $file->getClientOriginalName();
                    $separador = ".";
                    $separada = explode($separador, $archivo);
                    $nombre_arcvhivo = $separada[0];
                    $fechaActual = date ( 'd-m-Y_H_i_s' );
                    $nombre = $nombre_arcvhivo.'_'.$fechaActual.".".$file->getClientOriginalExtension();
                    $ruta = public_path("ArchivosGeneral\\".$nombre);

                    $ruta2= $nombre;

                    $datos = DB::transaction(function () use($request,$ruta2,$ruta,$i,$nombre_arcvhivo,$file){

                        $archivos = new ArchivoGeneral([
                            "nombre" => $nombre_arcvhivo,
                            "descripcion" => $request->input("descripcion"),
                            "url" => $ruta2,
                            "evento_id" => $request->input("evento_id"),
                        ]);
                        copy($file, $ruta);
                        $archivos->save();
                        return new ArchivosGeneralResource($archivos);
                    });

                }else{
                    return response()->json([
                        ("NO ES UN PDF")
                    ]);
                }

            }
        }
        return $datos;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArchivoGeneral  $archivoGeneral
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return new ArchivosGeneralResource(
            ArchivoGeneral::with([
                "evento",
            ])->findOrFail($id)
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArchivoGeneral  $archivoGeneral
     * @return \Illuminate\Http\Response
     */
    public function edit(ArchivoGeneral $archivoGeneral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArchivoGeneralRequest  $request
     * @param  \App\Models\ArchivoGeneral  $archivoGeneral
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArchivoGeneralRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArchivoGeneral  $archivoGeneral
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return  DB::transaction(function()use ($id){
            $archivoGeneral = ArchivoGeneral::findOrFail($id);
            $archivoGeneral->delete();
            return new ArchivosGeneralResource($archivoGeneral);
        });
    }

    public function download($url)
    {

        $path = 'ArchivosGeneral/'.$url;

        return response()->download($path);


    }
}
