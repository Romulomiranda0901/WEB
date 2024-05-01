<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function sedes(){
        return $this->hasMany(Sede::class);
    }
}
