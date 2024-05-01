<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class grupo_etnico extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [
        "nombres",
    ];

    public function participantes(){
        return $this->hasMany(Participante::class);
    }
}
