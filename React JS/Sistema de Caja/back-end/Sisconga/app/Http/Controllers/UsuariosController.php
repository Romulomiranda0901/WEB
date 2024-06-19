<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UsuariosController extends Controller
{
    public function Rols()
    {
        $resultados = DB::table('configuracion.rols as r')->select('r.id','r.nombre')->get();
        return response()->json($resultados, 200);
    }


}
