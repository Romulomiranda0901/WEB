<?php

namespace App\Http\Controllers;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TareaController extends Controller {
    /**
     * Muestra todas las tareas de la base de datos
     *
     * @return \Illuminate\Http\Response
     */
    protected function obtenerTareas () {
        try {
            $tareas = Tarea::mostRecent()->get();
            return response()->json($tareas, 200);
        }
        catch (\Exception $e) {
            return response()->json([
                "message" => "Error al obtener las tareas",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Almacena una nueva tarea en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function guardarTareas (Request $request) {
        try {
            $nombre = $request->tarea["nombre"];

            $nuevaTarea = new Tarea;
            $nuevaTarea->nombre = $nombre;
            $nuevaTarea->completado = false;
            $nuevaTarea->created_at = Carbon::now();
            $nuevaTarea->updated_at = Carbon::now();
            $nuevaTarea->save();

            return response()->json($nuevaTarea, 200);
        }
        catch (\Exception $e) {
            return response()->json([
                "message" => "Error al crear la tarea",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Actualiza el estado de la tarea a completado o no completado
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function completarTarea (Request $request, Int $id) {
        try {
            $getTarea = Tarea::find($id);
            if(!$getTarea) {
                return response()->json([
                    "message" => "Tarea no encontrada"
                ], 404);
            };
            $getTarea->completado = $request->completado;
            $getTarea->updated_at = Carbon::now();
            $getTarea->save();

            return response()->json($getTarea, 200);
            
        }
        catch (\Exception $e) {
            return response()->json([
                "message" => "Error al obtener la tarea",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Modificar una tarea
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function actualizarTarea (Request $request, Int $id) {
        try {
            $getTarea = Tarea::find($id);  
            if(!$getTarea){
                return response()->json([
                    "message" => "Tarea no encontrada"
                ], 404);
            }
            $getTarea->nombre = $request->tarea["nombre"];
            $getTarea->updated_at = Carbon::now() ;
            $getTarea->save();
            return response()->json($getTarea, 200);
           
        }
        catch (\Exception $e) {
            return response()->json([
                "message" => "Error al obtener la tarea",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Elimina una tarea de la base de datos
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function eliminarTarea (Int $id) {
        try {
            $getTarea = Tarea::find($id);
            if($getTarea) {
                $getTarea->delete();
                return response()->json($getTarea, 200);
            }
        }
        catch (\Exception $e) {
            return response()->json([
                "message" => "Error al obtener la tarea",
                "error" => $e->getMessage()
            ], 400);
        }
    }
}
