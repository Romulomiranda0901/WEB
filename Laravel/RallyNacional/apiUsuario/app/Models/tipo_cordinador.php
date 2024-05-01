<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_cordinador extends Model
{
    use HasFactory;

    public function CoordinadorSede(){
        return $this->hasMany(CoordinadorSede::class);
    }
}
