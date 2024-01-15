<?php

namespace App\Http\Controllers;

use App\Models\reporte_estado_cuenta_estudiante_carrera;
use Illuminate\Http\Request;

class estado_cuenta_estudiante_carrera extends Controller
{
    public function listado_sede(Request $request){
        try {
            $modelo = new reporte_estado_cuenta_estudiante_carrera();
            $resultado = $modelo->listado_sede();
            return response()->json($resultado, 200);
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }
    public function listado_subsedes(Request $request){
        try {
            $modelo = new reporte_estado_cuenta_estudiante_carrera();
            $resultado = $modelo->listado_subsedes();
            return response()->json($resultado, 200);
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function listar_carrera_sede(Request $request){
        try {
            $modelo = new reporte_estado_cuenta_estudiante_carrera();
            $resultado = $modelo->listar_carrera_sede($request->id_sede ,$request->id_subsede);
            return response()->json($resultado, 200);
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }
    public function turno(Request $request){
        try {
            $modelo = new reporte_estado_cuenta_estudiante_carrera();
            $resultado = $modelo->turno();
            return response()->json($resultado, 200);
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }
    public function listado_estado_cuenta_estudiante_carrera(Request $request){
        try {
            $modelo = new reporte_estado_cuenta_estudiante_carrera();
            $resultado = $modelo->listado_estado_cuenta_estudiante_carrera($request->id_carrera,$request->id_turno);
            return response()->json($resultado, 200);
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }
}
