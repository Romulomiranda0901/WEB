<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UsuariosController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\AutenticarController;

Route::post('/login', [AutenticarController::class, 'login']);




Route::middleware(['auth:sanctum'])->group(function () {
    // rutas para login
    Route::post('/logout', [AutenticarController::class, 'logout']);
    Route::post('/Rols',[UsuariosController::class,'Rols']);
    Route::post('/register',[ \App\Http\Controllers\AutenticarController::class,'register']);
    Route::get('/user/alive',[ \App\Http\Controllers\AutenticarController::class,'alive']);

    //  Route::get('/user', [AutenticarController::class, 'user']);
    // rutas para roles y permisos
    Route::post('/listar_permisos_menu',[\App\Http\Controllers\PermisosController::class,'listar_permisos_menu']);
    Route::post('/listar_menu',[\App\Http\Controllers\PermisosController::class,'listar_menu']);
    Route::post('/listar_permisos',[\App\Http\Controllers\PermisosController::class,'listar_permisos']);
    Route::post('/Crear_permisos',[\App\Http\Controllers\PermisosController::class,'Crear_permisos']);
    /// rutas para creacion de recibos
    Route::post('/listar_proceso',[\App\Http\Controllers\Recibos::class,'listar_proceso']);
    Route::post('/listar_caja',[\App\Http\Controllers\Recibos::class,'listar_caja']);
    Route::post('/listar_recibos',[\App\Http\Controllers\Recibos::class,'listar_recibos']);
    Route::post('/busqueda_cliente',[\App\Http\Controllers\Recibos::class,'busqueda_cliente']);
    Route::post('/crear_cliente',[\App\Http\Controllers\Recibos::class,'crear_cliente']);
    Route::post('/obtener_tipo_aracel',[\App\Http\Controllers\Recibos::class,'obtener_tipo_aracel']);
    Route::post('/obtener_tipo_moneda',[\App\Http\Controllers\Recibos::class,'obtener_tipo_moneda']);
    Route::post('/crear_recibo',[\App\Http\Controllers\Recibos::class,'crear_recibo']);
    Route::post('/crear_recibo_imprecion',[\App\Http\Controllers\Recibos::class,'crear_recibo_imprecion']);
    Route::post('/listar_carrera',[\App\Http\Controllers\Recibos::class,'listar_carrera']);
    Route::post('/crear_recibos_anulado',[\App\Http\Controllers\Recibos::class,'crear_recibos_anulado']);
    Route::post('/obtener_mes_pago',[\App\Http\Controllers\Recibos::class,'obtener_mes_pago']);
    Route::post('/obtener_arqueo_pendiente',[\App\Http\Controllers\Recibos::class,'obtener_arqueo_pendiente']);
    Route::post('/ver_recibos',[\App\Http\Controllers\Recibos::class,'ver_recibos']);
    Route::post('/update_tipo_cambio',[\App\Http\Controllers\Recibos::class,'update_tipo_cambio']);
    Route::post('/tipo_cambio',[\App\Http\Controllers\Recibos::class,'tipo_cambio']);
    Route::post('/forma_pago',[\App\Http\Controllers\Recibos::class,'forma_pago']);
    Route::post('/numero_recibos',[\App\Http\Controllers\Recibos::class,'numero_recibos']);
    Route::get('/obtener_estado_caja/{id}',[\App\Http\Controllers\Recibos::class,'obtener_estado_caja']);

    // ruta para arqueo de caja
    Route::post('/obtener_recibo_arqueo',[\App\Http\Controllers\Arqueo_caja::class,'obtener_recibo_arqueo']);
    Route::post('/obtener_total_arquear',[\App\Http\Controllers\Arqueo_caja::class,'obtener_total_arquear']);
    Route::post('/informacion_caja_arqueo',[\App\Http\Controllers\Arqueo_caja::class,'informacion_caja_arqueo']);
    Route::post('/denominaciones',[\App\Http\Controllers\Arqueo_caja::class,'denominaciones']);
    Route::post('/guardar_arqueo',[\App\Http\Controllers\Arqueo_caja::class,'guardar_arqueo']);
    Route::get('/ver_arqueo/{id}',[\App\Http\Controllers\Arqueo_caja::class,'ver_arqueo']);
    Route::post('/listado_arqueo',[\App\Http\Controllers\Arqueo_caja::class,'listado_arqueo']);


    // rutas para minutas de deposito
    Route::post('/ver_listado',[\App\Http\Controllers\minuta_depositos::class,'ver_listado']);
    Route::post('/busqueda_arqueo',[\App\Http\Controllers\minuta_depositos::class,'busqueda_arqueo']);
    Route::post('/cuentas',[\App\Http\Controllers\minuta_depositos::class,'cuentas']);
    Route::post('/listado_recibos',[\App\Http\Controllers\minuta_depositos::class,'listado_recibos']);
    Route::post('/totales',[\App\Http\Controllers\minuta_depositos::class,'totales']);
    Route::post('/ver',[\App\Http\Controllers\minuta_depositos::class,'ver']);
    Route::post('/guardar',[\App\Http\Controllers\minuta_depositos::class,'guardar']);
    Route::post('/finalizado',[\App\Http\Controllers\minuta_depositos::class,'finalizado']);

    // reporte cajas
    Route::post('/estado_cuenta_estudiante',[\App\Http\Controllers\estado_cuenta_estudiante::class,'estado_cuenta_estudiante']);
    Route::post('/listado_sede',[\App\Http\Controllers\estado_cuenta_estudiante_carrera::class,'listado_sede']);
    Route::post('/listado_subsedes',[\App\Http\Controllers\estado_cuenta_estudiante_carrera::class,'listado_subsedes']);
    Route::post('/listar_carrera_sede',[\App\Http\Controllers\estado_cuenta_estudiante_carrera::class,'listar_carrera_sede']);
    Route::post('/turno',[\App\Http\Controllers\estado_cuenta_estudiante_carrera::class,'turno']);
    Route::post('/listado_estado_cuenta_estudiante_carrera',[\App\Http\Controllers\estado_cuenta_estudiante_carrera::class,'listado_estado_cuenta_estudiante_carrera']);
    Route::post('/listado_consolidado_arqueo',[\App\Http\Controllers\Reporte_consolidado_arqueo::class,'listado_consolidado_arqueo']);

    // cuenta por cobrar

    Route::apiResource('cuentas', \App\Http\Controllers\CuentasPorCobrarController::class);
    //Route::post('/listado',[\App\Http\Controllers\Cuentas_Por_Cobrar::class,'listado']);
    //Route::post('/ver',[\App\Http\Controllers\Cuentas_Por_Cobrar::class,'ver']);
    //Route::post('/guardar',[\App\Http\Controllers\Cuentas_Por_Cobrar::class,'guardar']);
});












