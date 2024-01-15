<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submenu_hijos extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'icono',
        'id_submenu',
        'activo',
        'eliminado','created_at'
    ];
    public function submenu(){
        return $this->belongsTo(Submenu::class);
    }
}
