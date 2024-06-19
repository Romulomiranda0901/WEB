<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuenta_por_cobrar;

class CuentasPorCobrarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $modelo = new Cuenta_por_cobrar();
            $resultado = $modelo->listado($request->id_caja);
            return response()->json($resultado, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $modelo = new Cuenta_por_cobrar();
            $resultado = $modelo->guardar(
                $request->id_cliente,
                $request->id_tipopago,
                $request->id_caja,
                $request->id_mes,
                $request->datos_detalle
            );
            return response()->json($resultado, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $modelo = new Cuenta_por_cobrar();
            $resultado = $modelo->ver($id);
            return response()->json($resultado, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
