<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartamentoController extends Controller
{
    //
    public function ObtenerMunicipio($id_departamento)
    {
        $departamentos = DB::table('departamentos')
            ->join('municipios','departamentos.id', '=','municipios.departamento_id' )
            ->where('municipios.departamento_id','=',$id_departamento)
            ->select('municipios.*')
            ->get();

        return response()->json([
            "data" => $departamentos
        ]);
    }
}
