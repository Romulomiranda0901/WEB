<?php

namespace App\Http\Controllers;

use App\Http\Requests\Equipo\StoreRequest;
use App\Http\Requests\Equipo\UpdateRequest;
use App\Http\Resources\EquipoResource;
use App\Http\Resources\SedeResource;
use App\Models\Desafio;
use App\Models\Equipo;
use App\Models\EventoSede;
use App\Models\Genero;
use App\Models\grupo_etnico;
use App\Models\Participante;
use App\Models\Sede;
use Illuminate\Support\Facades\DB;

class EquipoController extends Controller
{
    public function listar()
    {
        return EquipoResource::collection(
            Equipo::with([
                "participantes.genero",
                "participantes.etnico:id,nombre",
                "coordinador",
                "sede",
                "desafio"
            ])->get()
        );
    }

    public function mostrar($id)
    {
        return new EquipoResource(
            Equipo::with([
                "participantes.genero",
                "participantes.etnico:id,nombre",
                "coordinador",
                "sede",
                "desafio"
            ])->findOrFail($id)
        );
    }

    public function crear(StoreRequest $request)
    {

        $sedes = Sede::with([
                'eventosede'
            ]
        )->findOrFail($request->input('sede_id'));

        $eventosede = $sedes->eventosede()->first();
        $max_participacion = $eventosede->max_participacion;
        $id_eventosede=$eventosede->id;


        $equipos =  EventoSede::with([
            'equipos'
        ])->findOrFail($id_eventosede)
            ->getRelation("equipos");


        foreach ($equipos as $equipo){
            $id_equipos[] = $equipo->id;
        }

        if (!empty($id_equipos)){


            foreach ($id_equipos as $id_equipo){
                $participante[] = Participante::where('equipo_id','=',$id_equipo)->get();

            }

            if (!empty($participante[0][0])){
                $tamaño =  count($participante);

                //var_dump($tamaño);

                for ($i = 0 ; $tamaño> $i ; $i++){
                    $tamaño2 =   count($participante[$i]);

                    for ($j = 0;$tamaño2>$j;$j++){
                        $datos_pary[] = $participante[$i][$j]->nombres;
                    }
                }

                $tamaño_parti =  count($datos_pary);
            }



        }
        else{
            $tamaño_parti = 0;
        }


        if ($max_participacion>=$tamaño_parti){


            return DB::transaction(function () use ($request) {
                $sede = Sede::findOrFail($request->input('sede_id'));
                $desafio = Desafio::findOrFail($request->input('desafio_id'));

                $equipo = new Equipo([
                    "nombre" => $request->nombre,

                ]);

                $equipo->sede()->associate($sede);
                $equipo->desafio()->associate($desafio);
                $equipo->save();

                foreach ($request->participantes as $participanteDatos) {
                    $genero = $participanteDatos["genero_id"];
                    $etnias = $participanteDatos["grupo_etnicos_id"];


                    $participante = new Participante([
                        "nombres" => $participanteDatos["nombres"],
                        "apellidos" => $participanteDatos["apellidos"],
                        "cedula" => $participanteDatos["cedula"]
                    ]);

                    $genero = Genero::findOrFail($genero);
                    $participante->genero()->associate($genero);

                    $etnias = grupo_etnico::findOrFail($etnias);
                    $participante->etnico()->associate($etnias);

                    $equipo->participantes()->save($participante);
                    $participante->refresh();



                    $existeCoordinador = array_key_exists("coordinador", $participanteDatos);
                    if ($existeCoordinador && $participanteDatos["coordinador"]) {
                        $equipo->coordinador()->associate($participante)->save();
                    }
                }

                $equipo->refresh();
                $equipo["participantes"] = $equipo->participantes()->get();
                return new EquipoResource($equipo);
            });
        }
        else{
            return response()->json([
                'msg' => 'se ha excedido el maximo de la sede seleccionada',
                'respuesta' => false
            ]);
        }


    }

    public function eliminar($id)
    {
        return DB::transaction(function () use ($id) {
            $equipo = Equipo::findOrFail($id);
            $equipo->participantes()->delete();
            $equipo->delete();
            return response()->json(["state" => true]);
        });
    }

    public function editar(UpdateRequest $request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $equipo = Equipo::findOrFail($id);
            if($request->input("nombre") !=null)
            {
                $equipo->nombre = $request->input("nombre");
            }
            if($request->input("sede_id") !=null)
            {
                $sede = Sede::findOrFail($request->input('sede_id'));
                $equipo->sede()->associate($sede);
            }

            if($request->input("desafio_id") !=null)
            {
                $desafio = Desafio::findOrFail($request->input('desafio_id'));
                $equipo->desafio()->associate($desafio);
            }

            $equipo->update();
            return new EquipoResource($equipo);
        });
    }
}
