<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private function agruparDatos(Collection $datos, $parentId = null)
    {
        $arbol = [];

        foreach ($datos as $dato) {
            if ($dato->parent_id == $parentId) {
                $hijos = $this->agruparDatos($datos, $dato->id);
                if ($hijos->count() > 0) {
                    $dato->hijos = $hijos;
                }
                $arbol[] = $dato;
            }
        }

        return collect($arbol);
    }

    private function agruparEnArbol(Collection $datos, &$arbol, $parentId = null)
    {
        foreach ($datos as $dato) {
            if ($dato->parent_id == $parentId) {
                $hijos = collect([]);
                $this->agruparEnArbol($datos, $hijos, $dato->id);
                if ($hijos->count() > 0) {
                    $dato->hijos = $hijos;
                }
                $arbol->push($dato);
            }
        }
    }
}
