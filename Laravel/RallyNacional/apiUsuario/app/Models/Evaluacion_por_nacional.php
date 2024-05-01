<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluacion_por_nacional extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $fillable = [
        "entregables_id",
        "nota_documento",
        "nota_video",
        "nota_final",
        'descripcion',
        'anyo'
    ];



    public function Entregable(){
        return $this->belongsTo(Entregable::class,'entregables_id');
    }
}
