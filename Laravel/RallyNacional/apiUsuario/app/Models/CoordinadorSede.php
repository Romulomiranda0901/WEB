<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoordinadorSede extends Model
{
    use HasFactory;

    public $fillable = [
        "sede_id",
        "cedula",
        "nombres",
        "apellidos",
        "genero_id",
        "tipo_cordinadors_id",
    ];
    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }

    public function genero(){
        return $this->belongsTo(Genero::class);
    }

    public function eventoSedeActual(){
        return $this->hasOne(EventoSede::class, "coordinador_id")
        ->where("evento_id", Evento::actual()->id);
    }

    public function usuario(){
        return $this->morphOne(User::class, "model");
    }

    public function tipo_cordinadors(){

         return $this->belongsTo(tipo_cordinador::class,'tipo_cordinadors_id');
    }
}
