<?php

namespace App\Http\Controllers;

use App\Models\productos;
use App\Http\Requests\StoreproductosRequest;
use App\Http\Requests\UpdateproductosRequest;
use App\Http\Resources\ProductosResource;
use Illuminate\Support\Facades\DB;
class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductosResource::collection(
            productos::all()
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
     * @param  \App\Http\Requests\StoreproductosRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreproductosRequest $request)
    {
        return DB::transaction(function () use($request){

            return (new ProductosResource( productos::create($request->all())))
                ->additional(['msg'=>'Datos Guardo Correctamente']);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        //
        return new  ProductosResource(
            productos::findOrFail($id)
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function edit(productos $productos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateproductosRequest  $request
     * @param  \App\Models\productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateproductosRequest $request,  $id)
    {
        //
        return DB::transaction(function () use ($request,$id) {
            $desafio = productos::findOrFail($id);


            $desafio->update($request->all());

            return  (new ProductosResource($desafio))
                ->additional(['msg'=>'Datos Actualizado Correctamente'])
                ->response()
                ->setStatusCode('202');
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //
        return DB::transaction(function () use ($id) {
            $equipo = productos::findOrFail($id);
            $equipo->delete();
            return  (new ProductosResource($equipo))->additional(['msg'=>'Datos Eliminado Correctamente']);
        });
    }
}
