<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EventoSede;
use App\Models\Sede;
use Carbon\Traits\Date;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParticipacionSedeController extends Controller
{
 
    public function obtenerlista()
    {
        try {
            return response()->json(
                EventoSede::with(
                    "sedes"
                )->get()
            );




            // return SedeResource::collection(Sede::all());
        } catch (Exception $exception)
        {
            return response()->json(
                [
                    "error" => $exception->getMessage()
                ]
            );
        }

    }

     public function GuardarParticipacion( Request $request)
     {
         try {
             $sedes = Sede::all();

             $sede = $sedes->find($request->sede_id); // Valido si la sede existe
             if($sede)
             {
                 $particpar_sede = new EventoSede([
                        "sede_id" => $request->sede_id,
                        "max_participacion" => $request->max_participacion,
                         "anyo" =>    date("Y")
                 ]);
                 //dd($particpar_sede);
                 $particpar_sede->save();

                 return response()->json([
                     "data" =>$particpar_sede,
                     'res' => true,
                     'msg' => 'Datos Registrado Correctamente'
                 ], 200);
             }
             else{
                 return response()->json([

                     'res' => false,
                     'msg' => 'La sedes no esta registrada'
                 ], 200);
             }



         } catch (Exception $ex)

         {
             return $ex->getMessage();
         }

     }

     public function actualizar_cupos(Request $request, EventoSede $EventoSede)
     {
         $valido = Validator::make($request->all(), [
             "max_participacion" => ["required"],
         ]);

         if ($valido->fails()) $response["mensajes"] = $valido->messages();
         else
         {
             $EventoSede->update($request->all());
             return response()->json([
                 'respuesta' => true,
                 'mensaje' => "Datos Actualizado Correctamente"
             ],200);
         }
     }

     public function eliminar_participacion($id)
     {
         $sede = EventoSede::findOrFail($id);
         $sede->delete();
         return response()->json([
             'respuesta' => true,
             'mensaje' => "Datos Eliminado Correctamente"
         ],200);
     }



}
