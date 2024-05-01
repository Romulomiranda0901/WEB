<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventoSede extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'max_participacion',
        'evento_id',
        'sede_id',
        'coordinador_id',
        'anyo'
    ];

    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }

    public function coordinador()
    {
        return $this->belongsTo(CoordinadorSede::class, "coordinador_id");
    }

    public function equipos(){
        return $this->hasMany(Equipo::class, "sede_id");
    }

    public function  evento()
    {
        return $this->belongsTo(Evento::class );
    }
}
