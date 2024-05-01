<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActualizarCategoriasResquest;
use App\Http\Resources\CategoriasResource;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Propuesta;
use Illuminate\Support\Facades\DB;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoriasResource::collection(Categoria::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        return (new CategoriasResource( Categoria::create($request->all())))
            ->additional(['msg'=>'Datos Guardo Correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        return new CategoriasResource($categoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActualizarCategoriasResquest $request,Categoria $categoria)
    {
        $categoria->update($request->all());
        return  (new CategoriasResource($categoria))
            ->additional(['msg'=>'Datos Actualizado Correctamente'])
            ->response()
            ->setStatusCode('202');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return  (new CategoriasResource($categoria))
            ->additional(['msg'=>'Datos Eliminado Correctamente']);
    }

    /**
     * Retornar las propuestas de una categoria
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function propuestas(int $id){
        return Propuesta::where('categoria_id', $id)
            ->get();
    }

    public function obtenerCategoria()
    {
        $categoria = DB::table('categorias')
            ->from('categorias','cat')
            ->select('cat.id')
            ->get();

        return response()->json([
            "data" => $categoria
        ]);
    }
}
