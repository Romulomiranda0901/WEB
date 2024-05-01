<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sede extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'municipio_id',
        'institucion_id'
    ];

    public function institucion()
    {
        return $this->belongsTo(Institucion::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function participacion()
    {
        return $this->hasMany(Participacion_sede::class, "sede_id");
    }

    public function cordinador_sede()
    {
        return $this->hasOne(CoordinadorSede::class, "sede_id");
    }
    public function eventosede()
    {
        return $this->hasMany(EventoSede::class);
    }


}
