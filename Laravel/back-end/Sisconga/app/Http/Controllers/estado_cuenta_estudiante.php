<?php

namespace App\Http\Controllers;

use App\Models\reporte_estado_cuenta_estudiante;
use Illuminate\Http\Request;

class estado_cuenta_estudiante extends Controller
{
    public function estado_cuenta_estudiante(Request $request){
        try {
            $modelo = new reporte_estado_cuenta_estudiante();
            $resultado = $modelo->estado_cuenta_estudiante($request->id_cliente,$request->id_turno);
            return response()->json($resultado, 200);
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

}
