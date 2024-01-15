<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productos extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nombres',
        'descripcion',
        'precio',
        'cantidad'
    ];


    // en los modelos se hace la relacion con los otros modelos aqui tenemos como se hace
    /*
       public function nombre_modelo(){
        return $this->belongsTo(nombre_modelo::class);
    }
     */
}




