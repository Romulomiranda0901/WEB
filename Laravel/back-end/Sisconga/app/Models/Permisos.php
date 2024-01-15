<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permisos extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'activo',
        'eliminado',
        'id_rol',
        'id_menu',
        'id_permis',
        'id_submenu',
        'id_submenuhijo','created_at'
    ];

    public function rols(){
        return $this->belongsTo(Rol::class);
    }

    public function menu(){
        return $this->belongsTo(Menu::class);
    }
    public function permis(){
        return $this->belongsTo(Permi::class);
    }
    public function submenu(){
        return $this->belongsTo(Submenu::class);
    }
    public function submenu_hijo(){
        return $this->belongsTo(Submenu_hijos::class);
    }


}
