<?php

namespace App\Http\Controllers;

use App\Models\Arqueo_cajas;
use Illuminate\Http\Request;

class Arqueo_caja extends Controller
{
    public function obtener_recibo_arqueo (Request $request){
        try {
            $modelo = new Arqueo_cajas();
            $resultado = $modelo->obtener_recibo_arqueo($request->id_caja,$request->id_tipo_moneda);

                return response()->json(['data' => $resultado], 200);

        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }


    public function obtener_total_arquear (Request $request){
        try {
            $modelo = new Arqueo_cajas();
            $resultado = $modelo->obtener_total_arquear($request->id_caja,$request->id_tipo_moneda);

            //$resultado = json_decode($resultado);


            return response()->json(['data' => $resultado], 200);

        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function informacion_caja_arqueo(Request $request){
        try {
            $modelo = new Arqueo_cajas();
            $resultado = $modelo->informacion_caja_arqueo($request->id_caja);

            return response()->json(['data' => $resultado], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }


    public function denominaciones (Request $request){
        try {
            $modelo = new Arqueo_cajas();
            $resultado = $modelo->denominaciones($request->id_tipo_moneda);
            return response()->json(['data' => $resultado], 200);

        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function guardar_arqueo (Request $request){
        try {
            $modelo = new Arqueo_cajas();
            $resultado = $modelo->guardar_arqueo($request->id_caja,$request->id_usuario,$request->anyo,$request->observacion,$request->sobrante_faltante,$request->datos);
            $resultado = json_decode($resultado, true);

            return response()->json(['data' => $resultado], 200);

        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function listado_arqueo (Request $request){
        try {
            $modelo = new Arqueo_cajas();
            $resultado = $modelo->listado_arqueo($request->id_caja);
            $resultado = json_decode($resultado, true);

            return response()->json(['data' => $resultado], 200);

        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function ver_arqueo ($id){
        try {
            $modelo = new Arqueo_cajas();
            $resultado = $modelo->ver_arqueo($id);
            return response()->json(['data' => $resultado], 200);

        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

}
