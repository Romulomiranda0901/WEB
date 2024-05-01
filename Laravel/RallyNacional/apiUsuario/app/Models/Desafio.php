<?php

namespace App\Models;

use App\Http\Controllers\Api\CategoriasController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Desafio extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'evento_id',
        'categoria_id',
        'patrocinadors_id',
        'nombre',
        'descripcion',
        'puntaje'
    ];


    public function evento(){
        return $this->belongsTo(evento::class);
    }
    public function categoria(){
        return $this->belongsTo(categoria::class);
    }
    public function patrocinadors(){
        return $this->belongsTo(Patrocinador::class);
    }

    public function entregable()
    {
        return $this->hasMany(Entregable::class, "desafio_id");
    }

    public function propuestas()
    {
        return $this->belongsToMany(
            Propuesta::class,
            "desafio_propuestas",
            "desafio_id",
            "propuesta_id"
        );
    }
}
