<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActualizarSedesRequest;
use App\Http\Requests\SedesRequest;
use App\Http\Resources\SedeResource;
use App\Models\EventoSede;
use Exception;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Sede;
use Illuminate\Support\Facades\DB;

class SedesController extends Controller
{

   //
//  Lista todas la sedes con la intuciones que pertenece
    public function index()
    {
        try {
            $sedes = Sede::with([
                    'institucion',
                    'municipio'

                ]
            )->get();

            foreach ($sedes as  &$sede){
                $municipio = $sede
                    ->municipio()
                    ->first();

                $departamento = $municipio->departamento()->first();
                $region = $departamento->region()->first();
                $sede["departamento"] = $departamento;
                $sede["region"] = $region;
            }

            return response()->json([
                'data' => $sedes
            ]);

            // return SedeResource::collection(Sede::all());
        } catch (Exception $exception) {
            return response()->json(
                [
                    "error" => $exception->getMessage()
                ]
            );
        }

        /*  return response()->json([
              "Departamento" => Region::with(["departamentos"])
                  ->get()
                  ->find($region)
          ]);*/
    }

    public function ObtenerSedes($id_institucion)
    {
        return response()->json([
            'Sedes' => Sede::with([
                'institucion',
                'municipio.departamento'
            ])->where('sedes.eliminado', '=', 'No')
                ->get()
                ->find($id_institucion)
        ]);

    }


    //Guarda la sedes
    public function guardarSedes(Request $request)
    {
        try {
            $sede = new Sede();
            $sede->nombre = $request->nombre;
            $sede->institucion_id = $request->institucion_id;
            $sede->municipio_id = $request->municipio_id;
            $sede->save();

            return response()->json([
                'res' => true,
                'msg' => 'Usuario Registrado Correctamente'
            ], 200);

            /* return (new SedeResource( Sede::create($request->all())))
                 ->additional(['msg'=>'Datos Guardo Correctamente']);*/


        } catch (Exception $ex) {
            return response()->json([
                'res' => false,
                'msg' => $ex->getMessage()
            ], 500);
        }

    }

    // Actualizar Sedes

    public function actualizar(ActualizarSedesRequest $request, Sede $sede)
    {

        try {
            $sede->update($request->all());
            return (new SedeResource($sede))
                ->additional(['msg' => 'Datos Actualizado Correctamente'])
                ->response()
                ->setStatusCode('202');
        } catch (Exception $ex) {
            return response()->json([
                'res' => false,
                'msg' => $ex->getMessage()
            ], 500);
        }


    }

    // Eliminado Logico de sedes, no se elimina solo cambia de estado

    public function eliminarSedes($id)
    {
        try {
            $sede = Sede::findOrFail($id);
            $sede->delete();
            return response()->json([
                'res' => true,
                'msg' => 'Datos Eliminado'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'res' => false,
                'msg' => $e->getMessage()
            ], 500);
        }
    }

    public function sede_eventosede(){
        $evento_sede = EventoSede::with([
                'sede'
            ]
        )->get();

        return response()->json([
            'data' => $evento_sede
        ]);
    }

    public function sede_lista()
    {
      $sedes  = DB::table('evento_sedes')
          ->join('sedes','sedes.id', '=','evento_sedes.sede_id' )
          ->join('coordinador_sedes','coordinador_sedes.id','=','evento_sedes.coordinador_id')
          ->select('evento_sedes.id','sedes.id as sedes_id','sedes.nombre','coordinador_sedes.id as coordinador_id','coordinador_sedes.nombres','coordinador_sedes.apellidos','evento_sedes.max_participacion')
          ->get();

      return \response()->json(
          [
              'data' => $sedes
          ]
      );
     // dd($sedes);
    }

    public  function obtenerSedeMuncipio($id_municipio)
    {
      $sede =  DB::table('sedes')
          ->join('municipios','municipios.id', '=', 'sedes.municipio_id')
          ->where('sedes.municipio_id', '=',$id_municipio )
          ->select('sedes.id', 'sedes.nombre')
          ->get();

      return response()->json([
          "data" => $sede
          ]
      );
    }



}
