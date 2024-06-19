<?php

namespace App\Http\Controllers;


use App\Models\Cuenta_por_cobrar;
use Illuminate\Http\Request;

class Cuentas_Por_Cobrar extends Controller
{
    public function listado(Request $request)
    {
        try {
            $modelo = new Cuenta_por_cobrar();
            $resultado = $modelo->listado($request->id_caja);
            return response()->json($resultado, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function ver(Request $request)
    {
        try {
            $modelo = new Cuenta_por_cobrar();
            $resultado = $modelo->ver($request->id_cuenta_por_pagar);
            return response()->json($resultado, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function guardar(Request $request)
    {
        try {
            $modelo = new Cuenta_por_cobrar();
            $resultado = $modelo->guardar($request->id_cliente, $request->id_tipopago,$request->id_caja, $request->id_mes,$request->datos_detalle);
            return response()->json($resultado, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }
}
