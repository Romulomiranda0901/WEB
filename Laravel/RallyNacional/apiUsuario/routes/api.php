<?php

use App\Http\Controllers\EvaluacionPorNacionalController;
use App\Http\Controllers\EvaluacionPorSedeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\InstitucionesController;
use App\Http\Controllers\Api\DepartamentoController;
use App\Http\Controllers\Api\AutenticarController;
use App\Http\Controllers\Api\CategoriasController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\SedesController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\Api\ParticipacionSedeController;
use App\Http\Controllers\ParticipanteController;
use \App\Http\Controllers\DesafioController;
use \App\Http\Controllers\EntregableController;
use \App\Http\Controllers\ArchivoGeneralController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\EventoSedeController;
use App\Models\Evento;
use App\Http\Controllers\PatrocinadorController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\PropuestaController;
use App\Http\Controllers\TipoCordinadorController;
use App\Http\Controllers\CriterioController;
use App\Models\Propuesta;
use Illuminate\Http\Request;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
Route::get('usuario',[UserController::class,'index']) ;
Route::post('usuario',[UserController::class,'store']) ;
Route::get('usuario/{usuario}',[UserController::class,'show']) ;
Route::put('usuario/{usuario}',[UserController::class,'update']) ;
Route::delete('usuario/{usuario}',[UserController::class,'destroy']);

Route::post('registro',[ AutenticarController::class,'registro']);*/

Route::post('login',[ AutenticarController::class,'login']);
Route::get('verificar_login',[ AutenticarController::class,'verificar_login']);

Route::group([ 'middleware' => ['auth:sanctum']], function (){
    Route::post('cerrarsesion',[ AutenticarController::class,'logout']);

    //Route::apiResource('usuario',UserController::class);
    // instituciones
    Route::group(['middleware' => ['role:admin|comite']], function () {
        //
        Route::prefix("institucion")->group(function () {
            Route::get('/listar', [InstitucionesController::class, 'index']);
            Route::post('/crear', [InstitucionesController::class, 'store']);
            Route::put('/editar/{institucion}', [InstitucionesController::class, 'update']);
            Route::delete('/eliminar/{id}', [InstitucionesController::class, 'destroy']);
            Route::get('/mostrar/{id}', [InstitucionesController::class, 'show']);
        });
    });


    //Sedes


    Route::group(['middleware' => ['role:admin|comite|coordinador_sede']], function () {
        Route::prefix('sede')->group(function () {
            Route::get('/listar', [SedesController::class, 'index']);
            Route::post('/crear', [SedesController::class, 'guardarSedes']);
            Route::put('/editar/{sede}', [SedesController::class, 'actualizar']);
            Route::delete('/eliminar/{id}', [SedesController::class, 'eliminarSedes']);
            Route::get('/mostrar/{id}', [SedesController::class, 'ObtenerSedes']);
            Route::get('/lista_eventosede',[SedesController::class, 'sede_eventosede']);
            Route::get('/sede_lista',[SedesController::class, 'sede_lista']);
            Route::get('/{id_municipio}/sedemunicipio',[SedesController::class, 'obtenerSedeMuncipio']);
            Route::prefix('evento')->group(function () {
                Route::post('/crear', [EventoSedeController::class, "crear"]);
                Route::put('/editar/{id}', [EventoSedeController::class, "editar"]);
                Route::delete('/eliminar/{id}', [EventoSedeController::class, "eliminar"]);
                Route::get('/{id}/equipos', [EventoSedeController::class, "equipos"]);
            });
        });
    });

    Route::group(['middleware' => ['role:admin|comite|coordinador_sede']], function () {
        //Equipo
        Route::prefix('equipo')->group(function () {
            Route::get('/listar', [EquipoController::class, "listar"]);
            Route::post('/crear', [EquipoController::class, "crear"]);
            Route::put('/editar/{id}', [EquipoController::class, "editar"]);
            Route::delete('/eliminar/{id}', [EquipoController::class, "eliminar"]);
            Route::get('/mostrar/{id}', [EquipoController::class, "mostrar"]);
        });

        //Participantes
        Route::prefix("participante")->group(function () {
            Route::get('/listar', [ParticipanteController::class, "listar"]);
            Route::post('/crear', [ParticipanteController::class, "crear"]);
            Route::put('/editar/{id}', [ParticipanteController::class, "editar"]);
            Route::delete('/eliminar/{id}', [ParticipanteController::class, "eliminar"]);
            Route::get('/mostrar/{id}', [ParticipanteController::class, "mostrar"]);
        });
    });

    Route::group(['middleware' => ['role:admin|comite']], function () {
        // Desafio
        Route::prefix("desafio")->group(function () {
            Route::get('/listar', [DesafioController::class, 'index']);
            Route::post('/crear', [DesafioController::class, 'store']);
            Route::put('/editar/{id}', [DesafioController::class, 'update']);
            Route::delete('/eliminar/{id}', [DesafioController::class, 'destroy']);
            Route::get('/mostrar/{id}', [DesafioController::class, 'show']);
        });
    });

    // Evaluciones
    Route::group(['middleware' => ['role:admin|comite']], function () {
        // Desafio
        Route::prefix("evaluacion_sede")->group(function () {
            Route::get('/listar', [EvaluacionPorSedeController::class, 'ganador_sede']);
            Route::get('/listar_equipo', [EvaluacionPorSedeController::class, 'listar_equipo']);
            Route::get('/buscar_equipo/{id}', [EvaluacionPorSedeController::class, 'buscar_equipo']);
            Route::get('/equipos_emtregable', [EvaluacionPorSedeController::class, 'listar_equipos_emtregable']);
            Route::get('/ganadores_sedes',[EvaluacionPorSedeController::class,'obtener_ganadores']);
            Route::put('/editar/{id}', [EvaluacionPorSedeController::class, 'update']);

        });

        Route::prefix("evaluacion_nacional")->group(function (){
            Route::get('listar',[EvaluacionPorNacionalController::class,'listar_equipo_nacional']);
            Route::get('ganadores_nacional',[EvaluacionPorNacionalController::class,'obtener_ganadores_nacional']);
            Route::post('crear',[EvaluacionPorNacionalController::class,'store']);
            Route::put('/editar/{id}',[EvaluacionPorNacionalController::class,'update']);


        });
    });




    Route::group(['middleware' => ['role:admin|equipo']], function () {
        // entregables
        Route::prefix("entregables")->group(function () {
            Route::get('/listar', [EntregableController::class, 'index']);
            Route::post('/crear', [EntregableController::class, 'store']);
            Route::put('/editar/{id}', [EntregableController::class, 'update']);
            Route::delete('/eliminar/{id}', [EntregableController::class, 'destroy']);
            Route::get('/mostrar/{id}', [EntregableController::class, 'show']);
        });
    });

    Route::group(['middleware' => ['role:admin']], function () {
        // ArchivoGeneral
        Route::prefix("archivosg")->group(function () {
            Route::post('/crear', [ArchivoGeneralController::class, 'store']);
            Route::get('/listar', [ArchivoGeneralController::class, 'index']);
            Route::put('/editar/{id}', [ArchivoGeneralController::class, 'update']);
            Route::delete('/eliminar/{id}', [ArchivoGeneralController::class, 'destroy']);
            Route::get('/mostrar/{id}', [ArchivoGeneralController::class, 'show']);
        });

        // Patrocinador

        Route::prefix("patrocinador")->group(function () {
            Route::get('/listar', [PatrocinadorController::class, 'index']);
            Route::post('/crear', [PatrocinadorController::class, 'store']);
            Route::put('/editar/{id}', [PatrocinadorController::class, 'update']);
            Route::delete('/eliminar/{id}', [PatrocinadorController::class, 'destroy']);
            Route::get('/mostrar/{id}', [PatrocinadorController::class, 'show']);
        });

        // Gestion de usuario

        Route::prefix("user")->group(function () {
            Route::post('/registrar',[ UserController::class,'store']);
            Route::get('/listar',[ AutenticarController::class,'listarUsuarioRol']);
            Route::get('/roles',[ AutenticarController::class,'ObtenerRoles']);
            Route::put('/editar/{id}',[ UserController::class,'update']);
        });


    });









});

//TODO:: Investigar si el CSRF-Token es necesario en APIs
Route::get("csrf-token", function () {
    return response()->json(["token" => csrf_token()]);
});


//Route::post('login', [AutenticarController::class, 'login']);
//Route::post('registrar', [AutenticarController::class, 'registrar']);

// public
Route::prefix("public")->group(function () {
    Route::get('/listar', [InstitucionesController::class, 'index']);
    Route::get('/listar_patrocinador', [PatrocinadorController::class, 'index']);
    Route::get('/listar_archivo', [ArchivoGeneralController::class, 'index']);
    Route::get('/download/{url}', [ArchivoGeneralController::class, 'download']);

});

//Regiones
Route::prefix('region')->group(function () {
    Route::get('/listar', [RegionController::class, 'index']);
    Route::get('/{id}/departamentos', [RegionController::class, 'buscarDepartamento']);
});

// Departamentos
Route::prefix('departamento')->group(function () {
    Route::get('/{id}/municipios', [DepartamentoController::class, 'ObtenerMunicipio']);
});

// GrupoEtnico
Route::prefix('etnico')->group(function () {
    Route::get('/listar', [\App\Http\Controllers\GrupoEtnicoController::class, 'index']);
});
//TipoCordinador

Route::prefix('tipocordinador')->group(function () {
    Route::get('/listar', [TipoCordinadorController::class, 'index']);
    Route::get('/coordinador', [TipoCordinadorController::class, 'CoordinadorTipo']);
});


//TODO:: Eliminar estas rutas y moverlas a sedes y re crearlas.
Route::prefix('particapar_sede')->group(function (){
    Route::get('/obtenerlista', [ParticipacionSedeController::class, "obtenerlista"]);
    Route::post('/GuardarParticipacion', [ParticipacionSedeController::class, "GuardarParticipacion"]);
    Route::put('/actualizar_cupos/{participacion_sede}', [ParticipacionSedeController::class, "actualizar_cupos"]);
    Route::delete('/eliminar_participacion/{id}', [ParticipacionSedeController::class, "eliminar_participacion"]);
});

Route::prefix('evento')->group(function () {
    Route::get("/actual", [EventoController::class, "actual"]);
    Route::get("/listar", [EventoController::class, "listar"]);
    Route::post("/crear", [EventoController::class, "crear"]);
    Route::put("/editar/{id}", [EventoController::class, "editar"]);
    Route::delete("/eliminar/{id}", [EventoController::class, "eliminar"]);
    Route::get("/mostrar/{id}", [EventoController::class, "mostrar"]);
    Route::get("/{id}/detallado", [EventoController::class, "detallado"]);
    Route::get("/{id}/{relacion}", [EventoController::class, "relacion"]);
});
 // Genero

Route::prefix('genero')->group( function (){
    Route::get("/listar", [GeneroController::class, "listar"]);
});

Route::prefix('propuestas')->group(function(){
    Route::get("/listar", [PropuestaController::class, "index"]);
    Route::post("/crear", [PropuestaController::class, "store"]);
    Route::put("/editar/{propuesta}", [PropuestaController::class, "update"]);
    Route::delete("/eliminar/{propuesta}", [PropuestaController::class, "destroy"]);
});

Route::prefix('categorias')->group(function(){

    Route::get("/listar", [CategoriasController::class, "index"]);
    Route::get("/{categoria}", [CategoriasController::class, "show"]);
    Route::get("/{categoria}/propuestas", [CategoriasController::class, "propuestas"]);
    Route::post("/crear", [CategoriasController::class, "store"]);
});

Route::prefix('criterios')->group(function(){

    Route::get("/listar", [CriterioController::class, "index"]);

});
