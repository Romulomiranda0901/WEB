<?php

namespace App\Http\Controllers;

use App\Http\Resources\PatrocinadorsResource;
use App\Models\Patrocinador;
use App\Http\Requests\StorePatrocinadorRequest;
use App\Http\Requests\UpdatePatrocinadorRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
class PatrocinadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PatrocinadorsResource::collection(
            Patrocinador::all()
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePatrocinadorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePatrocinadorRequest $request)
    {
        $files=$request->file();



        $nombre_patrocinador =$request->input("nombre_patrocinador");
        $ruta = public_path('Patrocinador/'.$nombre_patrocinador);


       //isDirectory () tomará un argumento como ruta de carpeta y devolverá true si la carpeta existe o false.
       if(!File::isDirectory($ruta)){
            //makeDirectory () tomará cuatro argumentos para crear una carpeta con permiso
            File::makeDirectory($ruta, 0777, true, true);
        }else{
            var_dump('Directorio Exite');
        }



           if($request->hasFile("imagen")){



               $file=$request->file("imagen");
                $destinationpatch = $ruta;
                $filename = time().'_'.$file->getClientOriginalName();
                $uploadsuccess = $request->file("imagen")->move($destinationpatch,$filename);

               // dd($imagen->getClientOriginalName());
                //$imagen->move($ruta,$nombreimagen);
               // copy($imagen->getRealPath(),$ruta);

                $ruta2="Patrocinador/".$nombre_patrocinador."/".$filename;

            }
            else{
                dd('No es Una imagen');
            }


        return DB::transaction(function () use($ruta2,$nombre_patrocinador){

            $archivos = new Patrocinador([
                "logo" => $ruta2,
                "nombre" => $nombre_patrocinador,
            ]);



            $archivos->save();
            return new PatrocinadorsResource($archivos);
        });

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patrocinador  $patrocinador
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DB::transaction(function () use($id){

            return (new PatrocinadorsResource( Patrocinador::findOrFail($id)));

        });

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePatrocinadorRequest  $request
     * @param  \App\Models\Patrocinador  $patrocinador
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePatrocinadorRequest $request, $id)
    {
        return DB::transaction(function () use ($request,$id) {

            $Patrocinador = Patrocinador::findOrFail($id);
            $Patrocinador->update($request->all());

            return  (new Patrocinador($id))
                ->additional(['msg'=>'Datos Actualizado Correctamente'])
                ->response()
                ->setStatusCode('202');
        });

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patrocinador  $patrocinador
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $Patrocinador = Patrocinador::findOrFail($id);
            $Patrocinador->delete();
            return response()->json(["state" => true]);
        });
    }
}
