<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;

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

Route::middleware("auth:sanctum")->get("/user", function (Request $request) {
    return $request->user();
});



Route::prefix("/tareas")->group(function () {
    Route::get("/", [TareaController::class, "obtenerTareas"]);
    // Crear
    Route::post("/",[TareaController::class, "guardarTareas"]);
    // Modificar
    Route::put("/{id}" , [TareaController::class, "actualizarTarea"]);
    // Eliminar
    Route::delete("/{id}", [TareaController::class, "eliminarTarea"] );
    // Completar
    Route::patch("/{id}" , [TareaController::class, "completarTarea"]);
});
