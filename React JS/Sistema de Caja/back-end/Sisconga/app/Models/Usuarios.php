<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
/**
 * @property int $id
 * @property string $inss
 * * @property string $contraseña
 */
class Usuarios extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'configuracion.usuarios';
    protected $fillable = [
        'nombres',
        'apellidos',
        'password',
        'correo',
        'inss',
        'id_rol',
        'activo',
        'eliminado','created_at'
    ];




    public function rols(){
        return $this->belongsTo(Rol::class);
    }
}
