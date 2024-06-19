<?php

namespace App\Http\Controllers;

use App\Models\Consolidado_arqueo;
use Illuminate\Http\Request;

class Reporte_consolidado_arqueo extends Controller
{
       public function listado_consolidado_arqueo(Request $request){
           try {
               $modelo = new Consolidado_arqueo();
               $resultado = $modelo->listado_consolidado_arqueo($request->id_caja,$request->fecha);
               return response()->json($resultado, 200);
           }catch (\Exception $e){
               return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
           }
       }
}
