<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActualizarUsuarioResquest;
use App\Http\Requests\GuardarUsuarioResquest;
use App\Http\Resources\UserResource;
use App\Models\Patrocinador;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       // return  User::all();
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return UserResource
     */
    public function store(GuardarUsuarioResquest $request)
    {



        try {
            $user = new User();
            $user->name = $request->name;
            $user->password = bcrypt($request->password);
            $user->evento_id = $request->evento_id;
            $user->save();
            $rol = $request->rol;
            $user1 = User::find($user->id);
            $user1->assignRole($rol);





            return response()->json([
                'res' => true,
                'usuario' => $user,
                'rol' =>$rol,
                'msg' => 'Usuario Registrado Correctamente'
            ], 200);
        } catch  (Exception $e)
        {
            return response()->json([
                'res' => false,
                'error' => $e->getMessage(),
                'msg' => 'Error al Momento de Guardar los datos'
            ]);
        }

       /* return (new UserResource( User::create($request->all())))
            ->additional(['msg'=>'Datos Guardo Correctamente']);*/

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //



        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActualizarUsuarioResquest $request,  $id)
    {
        //
        return DB::transaction(function () use ($request,$id) {

            $user = User::findOrFail($id);
            $user->update($request->all());

            return  (new UserResource($user))
                ->additional(['msg'=>'Datos Actualizado Correctamente'])
                ->response()
                ->setStatusCode('202');
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        //
        $usuario->delete();
        return  (new UserResource($usuario))->additional(['msg'=>'Paciente Eliminado Correctamente']);
    }


}
