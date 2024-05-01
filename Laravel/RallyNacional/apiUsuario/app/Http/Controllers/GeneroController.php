<?php

namespace App\Http\Controllers;


use App\Http\Resources\GeneroResource;
use App\Models\Genero;
use Illuminate\Http\Request;


class GeneroController extends Controller
{
    //

    public function listar()
    {
        return GeneroResource::collection(
            Genero::all()
        );
    }
}
