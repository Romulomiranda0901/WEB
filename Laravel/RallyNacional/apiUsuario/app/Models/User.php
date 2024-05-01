<?php

namespace App\Models;

use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Nette\Utils\Arrays;
use PhpParser\Node\Expr\Array_;
use Spatie\Permission\Traits\HasRoles;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'password',
        //'rol_id',
        'evento_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        //'email_verified_at' => 'datetime',
    ];

   /* public function rol()
    {
        return $this->belongsTo(Role::class);
    }*/

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    public function model(){
        return $this->morphTo();
    }

    public function validarActual()
    {
        $evento = Evento::actual();

      /*  $rol = DB::table('users as u')
            ->leftJoin('model_has_roles as mhr','mhr.model_id','u.id')
            ->leftJoin('roles as r','mhr.role_id','r.id')
            ->leftJoin('role_has_permissions as rhp','r.id','rhp.role_id')
            ->leftJoin('permissions as p','rhp.permission_id','p.id')
            ->where('u.id',$this->id,)
            ->select('r.id as id_roles','r.name as rol')
            ->orderBy('p.id')
            ->get();*/

        $rol = DB::table('users as u')
            ->leftJoin('model_has_roles as mhr','mhr.model_id','u.id')
            ->leftJoin('roles as r','mhr.role_id','r.id')
            ->where('u.id',$this->id,)
            ->select('r.id as id_roles','r.name as rol')
            ->orderBy('r.id')
            ->get();






        $permiso = DB::table('roles as r')
            ->leftJoin('role_has_permissions as rhp','r.id','rhp.role_id')
            ->leftJoin('permissions as p','rhp.permission_id','p.id')
            ->where('r.id',$rol[0]->id_roles)
            ->select('p.id as id_permiso','p.name as nombre as permiso')
            ->orderBy('p.id')
            ->get();





       /* $tamaño_rol = sizeof($permiso);




        for ($i =0;$i<$tamaño_rol;$i++){
            $datos[$i] = [
                "roles"=>[
                    "id_roles"=>$rol[0]->id_roles,
                    "rol"=>$rol[0]->rol,
                    "permisos"=>[
                        'id_permiso'=>$permiso[$i]->id_permiso,
                        "nombre"=>$permiso[$i]->nombre
                    ]
                ]
            ];
        }

        dd($datos);*/



        $NoEsActual = ($evento->id != $this->evento_id);
        $NoEsAdmin = ($this->rol_id !== 1);

        if ($NoEsActual && $NoEsAdmin) {
            throw new Exception("No esta registrado en el evento actual.");
        }

        return [
            "id" => $this->id,
            "name" => $this->name,
           "roles" => [
               "rol" => $rol,
               "permiso" =>$permiso
           ],
            "evento" => $this->evento()->get()
        ];
    }

}
