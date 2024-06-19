<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recibo;
use PHPUnit\Exception;

class Recibos extends Controller
{
    public function listar_proceso(){
        try {
            $modelo = new Recibo();
            $resultado = $modelo->listar_proceso();
            return response()->json($resultado, 200);
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function listar_caja(Request $request){
        try {
            $modelo = new Recibo();
            $resultado = $modelo->listar_cajas($request->id_usuario);
            return response()->json($resultado, 200);
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function listar_recibos(Request $request){
        try {
            $modelo = new Recibo();
            $resultado = $modelo->listar_recibos(
                $request->id_caja,
                $request->anyo_proceso
            );
            return response()->json(['data'=> $resultado], 200);
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function listar_carrera(Request $request){
        try {
            $modelo = new Recibo();
            $resultado = $modelo->listar_carrera_sede($request->id_caja);
            return response()->json($resultado, 200);
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function numero_recibos(Request $request){
        try {
            $modelo = new Recibo();
            $resultado = $modelo->numero_recibos($request->id_caja);
            return response()->json($resultado, 200);
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function busqueda_cliente(Request $request){
        try {
            $modelo = new Recibo();
            $resultado = $modelo->busqueda_cliente($request->carnet);
            return response()->json($resultado, 200);
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function crear_cliente(Request $request){
        try {
            $modelo = new Recibo();
            $resultado = $modelo->crear_cliente($request->carnet,$request->nombres,$request->apellidos,$request->carrera,$request->id_turno);
            return response()->json($resultado, 200);
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function obtener_tipo_aracel(Request $request){
        try {
            $modelo = new Recibo();
            $resultado = $modelo->obtener_tipo_aracel($request->id_carrera,$request->id_facultad,$request->id_turno);
            return response()->json($resultado, 200);
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function obtener_tipo_moneda(){
        try {
            $modelo = new Recibo();
            $resultado = $modelo->obtener_tipo_moneda();
            return response()->json($resultado, 200);
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function crear_recibo(Request $request){
        try {
            $modelo = new Recibo();
            $resultado = $modelo->crear_recibo(
                $request->id_cliente,
                $request->id_tipo_moneda,
                $request->id_caja,
                $request->id_usuario,
                $request->monto,
                $request->id_forma_pago,
                $request->numero_forma_pago,
                $request->datos_detalle
            );
            return response()->json(['message' => 'Guardado con exito','id_recibo'=> $resultado], 200);
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function crear_recibo_imprecion(Request $request){
        try {
            $modelo = new Recibo();
            $resultado = $modelo->crear_recibo_imprecion($request->id_recibo);
            return response()->json(['message' => 'Guardado con exito','id_imprecion'=> $resultado], 200);
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function crear_recibos_anulado(Request $request){
        try {
            $modelo = new Recibo();
            $resultado = $modelo->crear_recibos_anulado($request->id_recibo,$request->id_usuario,$request->observacion);
            return response()->json(['message' => 'Guardado con exito','id_recibo_anulado'=> $resultado], 200);
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function obtener_mes_pago(Request $request){
        try {
            $modelo = new Recibo();
            $resultado = $modelo->obtener_mes_pago($request->id_cliente);
            return response()->json(['message' => 'Meses Obtenido','meses'=> $resultado], 200);
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function ver_recibos(Request $request){
        try {
            $modelo = new Recibo();
            $resultado = $modelo->ver_recibos($request->id_recibo);
            return response()->json(['data'=> $resultado], 200);
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }


    public function obtener_arqueo_pendiente (Request $request){
        try {
            $modelo = new Recibo();
            $resultado = $modelo->obtener_arqueo_pendiente($request->id_usuario);
            $resultado = json_decode($resultado, true);
            if (empty($resultado)){
                return response()->json(['message' => false], 200);
            }else{
                return response()->json(['message' => true], 200);
            }

        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }



    public function update_tipo_cambio (Request $request){
        try {
            $modelo = new Recibo();
            $resultado = $modelo->update_tipo_cambio($request->monto);



                return response()->json(['message' => 'Tipo de Cambio Modificado con exito'], 200);


        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }



    public function tipo_cambio (){
        try {
            $modelo = new Recibo();
            $resultado = $modelo->tipo_cambio();


                return response()->json(['data' => $resultado], 200);


        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }


    public function forma_pago (){
        try {
            $modelo = new Recibo();
            $resultado = $modelo->forma_pago();


            return response()->json(['data' => $resultado], 200);


        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function obtener_estado_caja ($id_caja)
    {
        try {

            $modelo = new Recibo();
            $estado_caja = $modelo->obtener_estadocaja($id_caja);

            return response()->json($estado_caja);

        } catch (Exception $e)
        {
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }

    }



}
