<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParticipanteRequest;
use App\Http\Resources\ParticipanteResource;
use App\Models\Equipo;
use App\Models\Genero;
use App\Models\grupo_etnico;
use App\Models\Participante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParticipanteController extends Controller
{
    public function listar(){
        return ParticipanteResource::collection(
            Participante::with([
                "equipo",
                "genero",
                'etnico'
            ])->get()
        );
    }

    public function mostrar($id){
        return new ParticipanteResource(
            Participante::with([
                "equipo",
                "genero",
                "etnico"
            ])->findOrFail($id)
        );
    }

    public function crear(ParticipanteRequest $request){
        return  DB::transaction(function()use ($request){
            $participante = new Participante([
                "nombres" => $request->input("nombres"),
                "apellidos" => $request->input("apellidos"),
                "cedula" => $request->input("cedula")
            ]);

            $genero = Genero::findOrFail($request->input("genero")["id"]);
            $equipo = Equipo::findOrFail($request->input("equipo")["id"]);
            $etnico = grupo_etnico::findOrFail($request->input("grupo_etnico")["id"]);
            $participante->genero()->associate($genero);
            $participante->equipo()->associate($equipo);
            $participante->etnico()->associate($etnico);
            $participante->save();
            return new ParticipanteResource($participante);
        });
    }

    public function eliminar($id){
        return  DB::transaction(function()use ($id){
            $participante = Participante::findOrFail($id);
            $participante->delete();
            return new ParticipanteResource($participante);
        });
    }

    public function editar(ParticipanteRequest $request, $id){
        return  DB::transaction(function()use ($request, $id){
            $participante = Participante::findOrFail($id);
            $participante->nombres = $request->input("nombres");
            $participante->apellidos = $request->input("apellidos");
            $participante->cedula = $request->input("cedula");
            $genero = Genero::findOrFail($request->input("genero")["id"]);
            $equipo = Equipo::findOrFail($request->input("equipo")["id"]);
            $etnico = grupo_etnico::findOrFail($request->input("grupo_etnico")["id"]);
            $participante->genero()->associate($genero);
            $participante->equipo()->associate($equipo);
            $participante->etnico()->associate($etnico);
            $participante->update();
            return new ParticipanteResource($participante);
        });
    }
}
