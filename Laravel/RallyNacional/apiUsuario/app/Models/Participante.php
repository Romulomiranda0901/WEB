<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participante extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [
        "nombres",
        "apellidos",
        "genero_id",
        "cedula",
       "grupo_etnicos_id"
    ];

    public function equipo(){
        return $this->belongsTo(Equipo::class);
    }

    public function genero(){
        return $this->belongsTo(Genero::class);
    }

    public function etnico(){
        return $this->belongsTo(grupo_etnico::class,'grupo_etnicos_id');
    }

}
