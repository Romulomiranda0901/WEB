<?php

namespace App\Http\Controllers;

use App\Models\Propuesta;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class PropuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Propuesta::with('categoria')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string'],
            'categoria_id' => ['required', 'numeric']
        ]);

        $propuesta = Propuesta::create($validated);

        return response()->json($propuesta);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Propuesta  $propuesta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Propuesta $propuesta)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string'],
            'categoria_id' => ['required', 'numeric']
        ]);

        $propuesta->update($validated);
        return response()->json($propuesta);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Propuesta  $propuesta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Propuesta $propuesta)
    {
        return response()->json([
            'estado' => $propuesta->delete()
        ]);
    }
}
