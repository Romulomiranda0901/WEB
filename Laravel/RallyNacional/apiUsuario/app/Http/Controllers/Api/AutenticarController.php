<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginResquest;
use App\Http\Requests\RegistroResquest;
use App\Models\Evento;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Psy\Util\Json;


class AutenticarController extends Controller
{
    public function registrar(RegistroResquest $request)
    {
        $rol = Role::findOrFail($request->input('rol_id'));
        $persona = $rol->clase::findOrFail($request->input('persona_id'));

        switch($rol->id){
            case 2:
                $institucion = $persona->sede->institucion->nombre;
                preg_match_all('/[A-Z]/', $institucion, $matches, PREG_OFFSET_CAPTURE);
                $abreviacion = "";
                foreach($matches[0] as $letter){
                    $abreviacion = $abreviacion . $letter[0];
                }
                $username = $abreviacion . $persona->eventoSedeActual->id;
                break;
            case 3:
                $equipo = strtoupper(str_replace(" ", "", $persona->nombre));
                $equipo = preg_replace('([^A-Za-z0-9])', '', $equipo);
                $username = $equipo . $persona->sede->id;
            case 4:
                $equipo = strtoupper(str_replace(" ", "", $persona->nombre));
                $equipo = preg_replace('([^A-Za-z0-9])', '', $equipo);
                $username = $equipo . Evento::actual()->id;
        }

        $password = Str::random(8);

        $user = new User([
            "name" => $username,
            "password" => bcrypt($password),
            "evento_id" => Evento::actual()->id,
           // "rol_id" =>$rol
        ]);

      //  $user->rol()->associate($rol);
        $persona->usuario()->save($user);

        return Json::encode([
            "user" => $username,
            "password" => $password
        ]);
    }

    public  function login(LoginResquest $request)
    {
        if (Auth::attempt($request->only('name', 'password'))) {
            /** @var \App\Models\User **/
            $user = Auth::user();

            $userio = $request->input("name");

            $data['data'] = [
                'token' => $user->createToken('authToken')->plainTextToken,
                'user' => $user->validarActual(),
                'type' => 'Bearer',
                'res' => true
            ];

            return response()->json($data);
        }

        throw ValidationException::withMessages([
            'msg' => 'Credenciales incorrectas',
            'res' => false
        ]);
    }

    public function logout(Request $resquest)
    {

        $resquest->user()->currentAccessToken()->delete();
        return response()->json([
            'res' => true,
        ], 200);
    }

    public function verificar_login()
    {
        $user = Auth::user();
        dd($user);
    }

    public function listarUsuarioRol ()
    {
        $user = DB::table('users as u')
            ->leftJoin('model_has_roles as mhr','mhr.model_id','u.id')
            ->leftJoin('roles as r','mhr.role_id','r.id')
            ->where('u.anyo',date("Y"))
            ->select('u.id as id','u.name as usuario','u.evento_id', 'r.id as id_rol',
                'r.name as tipo_rol')
            ->orderBy('r.name')
            ->get();

        return['data' =>$user];
    }

    public function ObtenerRoles()
    {
        $roles = DB::table('roles')
            ->select('id','name')
            ->orderBy('name')
            ->get();

        return['data' =>$roles];

    }
}
