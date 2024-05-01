<?php

namespace App\Http\Controllers;

use App\Http\Resources\CriterioResource;
use App\Http\Resources\PatrocinadorsResource;
use App\Models\Criterio;
use Illuminate\Http\Request;

class CriterioController extends Controller
{
    //
    public function index()
    {
        return CriterioResource::collection(
            Criterio::all()
        );
    }
}
