<?php

namespace App\Http\Controllers;
use App\Http\Resources\GrupoEtnicoResource;
use App\Models\grupo_etnico;
use App\Http\Requests\Storegrupo_etnicoRequest;
use App\Http\Requests\Updategrupo_etnicoRequest;

class GrupoEtnicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return GrupoEtnicoResource::collection(
            grupo_etnico::all()
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
     * @param  \App\Http\Requests\Storegrupo_etnicoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storegrupo_etnicoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\grupo_etnico  $grupo_etnico
     * @return \Illuminate\Http\Response
     */
    public function show(grupo_etnico $grupo_etnico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\grupo_etnico  $grupo_etnico
     * @return \Illuminate\Http\Response
     */
    public function edit(grupo_etnico $grupo_etnico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updategrupo_etnicoRequest  $request
     * @param  \App\Models\grupo_etnico  $grupo_etnico
     * @return \Illuminate\Http\Response
     */
    public function update(Updategrupo_etnicoRequest $request, grupo_etnico $grupo_etnico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\grupo_etnico  $grupo_etnico
     * @return \Illuminate\Http\Response
     */
    public function destroy(grupo_etnico $grupo_etnico)
    {
        //
    }
}
