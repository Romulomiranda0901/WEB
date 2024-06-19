<?php

namespace App\Http\Controllers;

use App\Models\minuta_desposito;
use Illuminate\Http\Request;

class minuta_depositos extends Controller
{
    public function ver_listado (Request $request){
        try {
            $modelo = new minuta_desposito();
            $resultado = $modelo->ver_listado($request->id_caja,$request->anyo);

            return response()->json(['data' => $resultado], 200);

        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function busqueda_arqueo (Request $request){
        try {
            $modelo = new minuta_desposito();
            $resultado = $modelo->busqueda_arqueo($request->mumero_arqueo);

            return response()->json(['data' => $resultado], 200);

        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function cuentas(Request $request){
        try {
            $modelo = new minuta_desposito();
            $resultado = $modelo->cuentas($request->id_tipo_moneda);

            return response()->json(['data' => $resultado], 200);

        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function listado_recibos(Request $request){
        try {
            $modelo = new minuta_desposito();
            $resultado = $modelo->listado_recibos($request->id_arqueo,$request->id_tipo_moenda);

            return response()->json(['data' => $resultado], 200);

        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function totales(Request $request){
        try {
            $modelo = new minuta_desposito();
            $resultado = $modelo->totales($request->id_arqueo,$request->id_tipo_moenda);

            return response()->json(['data' => $resultado], 200);

        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }


    public function ver (Request $request){
        try {
            $modelo = new minuta_desposito();
            $resultado = $modelo->ver($request->id_minuta);

            return response()->json(['data' => $resultado], 200);

        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function guardar (Request $request){
        try {
            $modelo = new minuta_desposito();
            $resultado = $modelo->guardar($request->id_arqueo,$request->numero_deposito,$request->monto,$request->id_cuenta,$request->id_usuario,$request->anyo);

            return response()->json(['data' => $resultado], 200);

        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function finalizado (Request $request){
        try {
            $modelo = new minuta_desposito();
            $resultado = $modelo->finalizado($request->id_minuta);

            return response()->json(['data' => $resultado], 200);

        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

}
