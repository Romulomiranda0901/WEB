<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Nombre de la clase Individual, para que Eloquent busque sola su tabla
//Consejo para apagerse a las normas de Laravel
class Institucion extends Model
{
    use HasFactory;

    //En este caso laravel busca su versión a ingles "institutions"
    protected $table = "instituciones";
    //Consultar si deberian guardar a que hora se guardo la institucion
    //protected $timestamps = false;

    //No es necesario si solo sera un catalogo.
    protected $fillable = [
        'nombre',
        'abreviacion'
    ];

    /* No es necesario si el Timestamps no esta en la migración
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    */

    public function sedes(){
        return $this->hasMany(Sede::class);
    }
}
