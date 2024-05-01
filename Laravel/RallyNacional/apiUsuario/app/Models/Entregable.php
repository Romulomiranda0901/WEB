<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entregable extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [

        'desafio_id',
        'tipo_archivo_id',
        'criterio_id',
        'nombre',
        'descripcion',
        'equipo_id',
        'link'
    ];

    public function desafio(){
        return $this->belongsTo(Desafio::class);
    }

    public function equipo(){
        return $this->belongsTo(equipo::class);
    }

    public function criterio(){
        return $this->belongsTo(Criterio::class);
    }



    public function Evaluacion_por_nacional()
    {
        return $this->hasMany(Evaluacion_por_nacional::class, "entregables_id");
    }

    public function Evaluacion_por_sede()
    {
        return $this->hasMany(Evaluacion_por_sede::class, "entregables_id");
    }
}
