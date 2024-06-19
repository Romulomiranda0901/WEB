<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginResquest;
use App\Http\Requests\RegistroResquest;
use App\Http\Requests\StoreUsuariosRequest;
use App\Models\Usuarios;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Psy\Util\Json;
use Illuminate\Support\Facades\Hash;



class AutenticarController extends Controller
{
    public function login(Request $request)
    {

        $credentials = $request->validate([
            'inss' => 'required',
            'password' => 'required',
        ]);


        if (Auth::attempt($credentials)) {

            $user = auth()->user();
            $nombre_completo = $user->nombres . " " . $user->apellidos;
            $id_user = $user->id;
            $id_rol = $user->id_rol;
            $token = auth()->user()->createToken('token-name')->plainTextToken;
            $data = ['nombres' => $nombre_completo, 'id_user' => $id_user, 'id_rol' => $id_rol, 'token' => $token];
            return response()->json(['data' => $data, 'message' => 'Authentication successful']);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logout successful']);
    }

    public function user(Request $request)
    {
        return $request->user();
    }


    public function register(StoreUsuariosRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $request->validate([
                    'nombres' => 'required|string',
                    'apellidos' => 'required|string',
                    'correo' => 'required|email',
                    'inss' => 'required|string',
                    'password' => 'required|min:6',
                    'id_rol' => 'required|int'
                ]);
                if (empty($this->validation_user($request->inss, $request->id_rol))) {
                    // Crear el usuario
                    $user = Usuarios::create([
                        'nombres' => $request->nombres,
                        'apellidos' => $request->apellidos,
                        'correo' => $request->correo,
                        'inss' => $request->inss,
                        'password' => bcrypt($request->password),
                        'id_rol' => $request->id_rol,
                        'created_at' => date("Y-m-d H:i:s")
                    ]);



                    if (!empty($user)) {
                        return response()->json(['inss' =>  $user->inss, 'password' => $request->password, 'message' => 'Usuario creado successful'], 201);
                    } else {
                        return response()->json(['message' =>  'no se pudo crear el usuario'], 400);
                    }
                } else {
                    return response()->json(['message' =>  'ya existe un usuario con ese inss :' . $request->inss], 400);
                }
            });
        } catch (\Exception $e) {
            // Manejar la excepción
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function validation_user($inns, $id_rol)
    {
        try {
            $datos =  DB::table("configutacion.usuarios")->where('inss', '=', $inns)->where('id_rol', '=', $id_rol)->get();
            return $datos;
        } catch (Exception $e) {
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function alive()
    {
        return response()->noContent();
    }
}
