<?php

namespace App\Http\Controllers;

use App\Models\Tarea;

class PagesController extends Controller {
    protected function index () {
        try {
            $tareas = Tarea::mostRecent()->get();
            return inertia("index", [
                "tareas" => $tareas
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                "message" => "Error al obtener las tareas",
                "error" => $e->getMessage()
            ], 400);
        }
    }
    protected function about () {
        return inertia("about");
    }
}
