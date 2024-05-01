<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventoRequest;
use App\Http\Resources\EventoResource;
use App\Models\Evento;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class EventoController extends Controller
{

    private $evento;


    public function __construct()
    {
       $id = Route::current()->parameter('id');

        if(!$id) return;
        $this->evento = ($id === "actual") ?  Evento::actual() : Evento::findOrFail($id);

    }

    public function actual()
    {

        return (new EventoResource(
            Evento::actual()
        ));
    }


    public function listar()
    {
        return EventoResource::collection(
            Evento::all()
        );
    }

    public function crear(EventoRequest $request)
    {
        return DB::transaction(function () use ($request) {

            $requestAll = $request->all();
            self::convertirFechas($requestAll);

            $evento = Evento::create($requestAll);

            return (new EventoResource(
                $evento
            ));
        });
    }

    public function editar(EventoRequest $request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $evento = Evento::findOrFail($id);

            $requestAll = $request->all();
            self::convertirFechas($requestAll);

            $evento->update($requestAll);

            return (new EventoResource(
                $evento
            ));
        });
    }

    public function eliminar($id){
        return DB::transaction(function () use ($id) {
            $evento = Evento::findOrFail($id);
            $evento->delete();
            return (new EventoResource(
                $evento
            ));
        });
    }

    public function detallado($id)
    {
        $eventoSedes = $this->evento->with([
            "eventoSede.sede",
            "eventoSede.coordinador.genero",
        ])->first();

        return (new EventoResource(
            $eventoSedes->getRelation("eventoSede")
        ));
    }

    public function relacion($id, $relacion)
    {
        $data = $this->evento->with([
            $relacion
        ])->first();

        return (new EventoResource(
            $data->getRelation($relacion)
        ));
    }

    private static function convertirFechas(&$fechas)
    {
        $keys = [
            "fecha_inicia",
            "fecha_finaliza"
        ];

        foreach($keys as $key){
            $fecha = strtotime($fechas[$key]);
            $fechas[$key] = date("Y-m-d", $fecha);
            $comparacion[] = $fecha;
        }

        [
            $fechaInicio,
            $fechaFinaliza
        ] = $comparacion;

        if($fechaInicio > $fechaFinaliza)
            throw new Exception("La fecha finaliza debe ser mayor a la fecha inicia");
    }
}
