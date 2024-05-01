<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipo extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [
        "nombre",
        "sede_id",
        "desafio_id"
    ];

    public function participantes(){
        return $this->hasMany(Participante::class);
    }

    public function sede(){
        return $this->belongsTo(Sede::class);
    }

    public function coordinador(){
        return $this->belongsTo(Participante::class, "coordinador_id");
    }

    public function entregable(){
        return $this->belongsTo(Entregable::class);
    }

    public function usuario(){
        return $this->morphOne(User::class, "model");
    }

    public function desafio()
    {
        return $this->belongsTo(Desafio::class);
    }
}
