<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evento extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [
        'id',
        "nombre",
        "fecha_inicia",
        "fecha_finaliza",
        "anyo"
    ];

    public function sedes(){
        return $this->belongsToMany(Sede::class, "evento_sedes");
    }

    public function coordinadores(){
        return $this->belongsToMany(CoordinadorSede::class,
            "evento_sedes",
            "evento_id",
            "coordinador_id"
        );
    }

    public function eventoSede(){
        return $this->hasMany(EventoSede::class);
    }

    public function equipos(){
        return $this->hasManyThrough(Equipo::class, EventoSede::class);
    }

    public static function actual(){
        return self::whereDate("fecha_inicia", "<=", date("Y-m-d"))
            ->whereDate("fecha_finaliza", ">=", date("Y-m-d"))
            ->first();
    }

    public function archivogeneral()
    {
        return $this->hasMany(ArchivoGeneral::class, "evento_id");
    }

    public function desafio()
    {
        return $this->hasMany(Desafio::class, "evento_id");
    }

}
