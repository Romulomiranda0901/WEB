<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submenu extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'activo',
        'eliminado',
        'nombre',
        'icono',
        'id_menu',
        'created_at',
    ];

    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
