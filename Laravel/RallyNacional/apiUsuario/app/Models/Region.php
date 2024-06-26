<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = "regiones";

    public function departamentos(){
        return $this->hasMany(Departamento::class);
    }
}
