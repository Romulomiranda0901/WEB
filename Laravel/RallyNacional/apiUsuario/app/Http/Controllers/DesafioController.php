<?php

namespace App\Http\Controllers;

use App\Http\Resources\DesafioResource;
use App\Models\Desafio;
use App\Http\Requests\StoreDesafioRequest;
use App\Http\Requests\UpdateDesafioRequest;
use Illuminate\Support\Facades\DB;

class DesafioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DesafioResource::collection(
            Desafio::all()
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDesafioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDesafioRequest $request)
    {
        return DB::transaction(function () use($request){

            return (new DesafioResource( Desafio::create($request->all())))
                ->additional(['msg'=>'Datos Guardo Correctamente']);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Desafio  $desafio
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new  DesafioResource(
            Desafio::findOrFail($id)
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Desafio  $desafio
     * @return \Illuminate\Http\Response
     */
    public function edit(Desafio $desafio)
    {

    }


    public function update(UpdateDesafioRequest $request, $id)
    {
        return DB::transaction(function () use ($request,$id) {
            $desafio = Desafio::findOrFail($id);


            $desafio->update($request->all());

            return  (new DesafioResource($desafio))
                ->additional(['msg'=>'Datos Actualizado Correctamente'])
                ->response()
                ->setStatusCode('202');
        });


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Desafio  $desafio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $equipo = Desafio::findOrFail($id);
            $equipo->delete();
            return  (new DesafioResource($equipo))->additional(['msg'=>'Datos Eliminado Correctamente']);
        });
    }
}
