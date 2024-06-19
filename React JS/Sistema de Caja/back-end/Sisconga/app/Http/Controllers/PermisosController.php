<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermisosResource;
use App\Models\Permisos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\Translation\t;

class PermisosController extends Controller
{
//prueba
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listar_permisos_menu(Request $request)
    {

        $menu_permisos =  DB::table('configuracion.permisos as p')
            ->leftJoin('configuracion.menus as m', 'p.id_menu', '=', 'm.id')
            ->join('configuracion.permis as per', 'p.id_permis', '=', 'per.id')
            ->where('p.id_rol','=',$request->id_rol)
            ->where('p.eliminado','=','NO')
            ->where('p.activo','=','SI')
            ->whereNotNull('m.id')
            ->select('m.id as id_menu','m.nombre as menu','m.icono as icono_menu','per.id as permis_id','per.nombre as nombre_permi','m.url')
            ->get()
            ->toArray();

        $sub_menu_permisos =  DB::table('configuracion.permisos as p')
            ->leftJoin('configuracion.submenus as sm', 'p.id_submenu', '=', 'sm.id')
            ->join('configuracion.permis as per', 'p.id_permis', '=', 'per.id')
            ->where('p.id_rol','=',$request->id_rol)
            ->where('p.eliminado','=','NO')
            ->where('p.activo','=','SI')
            ->whereNotNull('sm.id')
            ->select('sm.id as id_submenu','sm.nombre as nombre_submenu','sm.icono as icono_submenu','per.id as permis_id','per.nombre as nombre_permi','sm.id_menu','sm.url')
            ->get();

        $sub_menu_permisos_hijos =  DB::table('configuracion.permisos as p')
            ->leftJoin('configuracion.submenu_hijos as smh', 'p.id_submenuhijo', '=', 'smh.id')
            ->join('configuracion.permis as per', 'p.id_permis', '=', 'per.id')
            ->where('p.id_rol','=',$request->id_rol)
            ->where('p.eliminado','=','NO')
            ->where('p.activo','=','SI')
            ->whereNotNull('smh.id')
            ->select('smh.id as id_submenu_hijos','smh.nombre as nombre_submenu_hijo','smh.icono as icono_submenuhijo','per.id as permis_id','per.nombre as nombre_permi','smh.id_submenu','smh.url')
            ->get();


            $resultados = ['menu'=>$menu_permisos,'sub_menu'=>$sub_menu_permisos,'submenu_hijo'=>$sub_menu_permisos_hijos];






        // Arrays para almacenar los datos agrupados
        $menus = [];
        $submenus = [];
        $submenus_hijo = [];

// Recorremos el array original
        foreach ($resultados['menu'] as $menuItem) {
            $menuId = $menuItem->id_menu;
            $permisId = $menuItem->permis_id;

            // Agrupar por menu
            if (!isset($menus[$menuId])) {
                $menus[$menuId] = [
                    'menu' => $menuItem->menu,
                    'id_menu'=> $menuItem->id_menu,
                    'icono'=>$menuItem->icono_menu,
                    'url'=>$menuItem->url,
                    'permisos' => [],
                ];
            }

            // Agrupar por permiso
            if (!isset($menus[$menuId]['permisos'][$permisId])) {
                $menus[$menuId]['permisos'][$permisId] = [
                    'nombre_permi' => $menuItem->nombre_permi,
                    'submenus' => [],
                ];
            }
        }

        foreach ($resultados['sub_menu'] as $submenuItem) {
            $submenuId = $submenuItem->id_submenu;
            $permisId = $submenuItem->permis_id;
            $menuId = $submenuItem->id_menu;

            // Agrupar por submenu
            if (!isset($submenus[$submenuId])) {
                $submenus[$submenuId] = [
                    'nombre_submenu' => $submenuItem->nombre_submenu,
                    'id_submenu'=> $submenuItem->id_submenu,
                    'icono'=> $submenuItem->icono_submenu,
                    'url'=>$submenuItem->url,
                    'permisos' => [],
                ];
            }

            // Agrupar por permiso en submenu
            if (!isset($submenus[$submenuId]['permisos'][$permisId])) {
                $submenus[$submenuId]['permisos'][$permisId] = [
                    'nombre_permi' => $submenuItem->nombre_permi,
                ];
            }

            // Agregar relación con el menú
            $submenus[$submenuId]['id_menu'] = $menuId;
        }

        foreach ($resultados['submenu_hijo'] as $submenuhijoItem) {

            $submenuid_submenu_hijosId = $submenuhijoItem->id_submenu_hijos;
            $permisid_submenu_hijosId = $submenuhijoItem->permis_id;
            $menuid_submenu_hijosId = $submenuhijoItem->id_submenu;

            // Agrupar por submenu
            if (!isset($submenus_hijo[$submenuid_submenu_hijosId])) {
                $submenus_hijo[$submenuid_submenu_hijosId] = [
                    'nombre_submenu' => $submenuhijoItem->nombre_submenu_hijo,
                    'id_submenu_hijo'=> $submenuhijoItem->id_submenu_hijos,
                    'icono'=> $submenuhijoItem->icono_submenuhijo,
                    'url'=>$submenuhijoItem->url,
                    'permisos' => [],
                ];
            }

            // Agrupar por permiso en submenu
            if (!isset($submenus_hijo[$submenuid_submenu_hijosId]['permisos'][$permisid_submenu_hijosId])) {
                $submenus_hijo[$submenuid_submenu_hijosId]['permisos'][$permisid_submenu_hijosId] = [
                    'nombre_permi' => $submenuhijoItem->nombre_permi,
                ];
            }

            // Agregar relación con el menú
            $submenus_hijo[$submenuid_submenu_hijosId]['id_submenu'] = $menuid_submenu_hijosId;
        }


        $resultado = [
            'menus' => array_values($menus),
            'submenus' => array_values($submenus),
            'submenu_hijo' => array_values($submenus_hijo),
        ];



        return response()->json($resultado, 200);
    }


    public function Crear_permisos(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $request->validate([
                    'id_rol' => 'required|int',
                    'id_permis' => 'required|int'
                ]);


                if (!empty($request->id_menu)) {
                    if (empty($this->validar_permiso_menu($request->id_menu, $request->id_permis, $request->id_rol))) {
                        Permisos::create([
                            'id_menu' => $request->id_menu,
                            'id_permis' => 1,
                            'id_rol' => $request->id_rol,
                            'created_at' => date("Y-m-d H:i:s")
                        ]);
                    }
                }

                if (!empty($request->id_submenu)) {
                    if (empty($request->id_submenuhijo)) {
                        if (empty($this->validar_permiso_submenu($request->id_submenu, $request->id_permis, $request->id_rol))) {
                            $menu = Permisos::create([
                                'id_menu' => $request->id_submenu,
                                'id_permis' => $request->id_permis,
                                'id_rol' => $request->id_rol,
                                'created_at' => date("Y-m-d H:i:s")
                            ]);

                            if (!empty($menu)) {
                                return response()->json(['message' => 'Permiso creado successful'], 201);
                            } else {
                                return response()->json(['message' => 'no se pudo crear el Permiso'], 400);
                            }
                        }
                    } else {
                        Permisos::create([
                            'id_menu' => $request->id_submenu,
                            'id_permis' => 1,
                            'id_rol' => $request->id_rol,
                            'created_at' => date("Y-m-d H:i:s")
                        ]);
                    }
                }

                if (!empty($request->id_submenuhijo)) {
                    if (empty($this->validar_permiso_submenuhijo($request->id_submenuhijo, $request->id_permis, $request->id_rol))) {
                        $sub_menu = Permisos::create([
                            'id_menu' => $request->id_submenuhijo,
                            'id_permis' => $request->id_permis,
                            'id_rol' => $request->id_rol,
                            'created_at' => date("Y-m-d H:i:s")
                        ]);
                        if (!empty($sub_menu)) {
                            return response()->json(['message' => 'Permiso creado successful'], 201);
                        } else {
                            return response()->json(['message' => 'no se pudo crear el Permiso'], 400);
                        }
                    }
                }

            });


        }catch (\Exception $e) {
            // Manejar la excepción
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }



    }

    public function listar_menu (Request $request)
    {
        try {
            $datos = $this->listar_tipo_permisos_menu($request->id_rol);
            $datos2 = $this->listar_tipo_permisos_submenu($request->id_rol);
            $datos3 = $this->listar_tipo_permisos_submenuhijo($request->id_rol);


            $menu=  DB::table('configuracion.menus as m')
                ->leftJoin('configuracion.submenus as sm', 'sm.id_menu', '=', 'm.id')
                ->leftJoin('configuracion.submenu_hijos as smh', 'smh.id_submenu', '=', 'sm.id')
                ->whereNotIn('m.id',$datos)
                ->whereNotIn('sm.id',$datos2)
                ->whereNotIn('smh.id',$datos3)
                ->select('m.id as id_menu','m.nombre as menu','sm.id as id_submenu','sm.nombre as nombre_submenu','smh.id as id_submenu_hijos','smh.nombre as nombre_submenu_hijo')
                ->get();

            $arrayResultante = json_decode($menu, true);
            $gruposPorMenu = array_reduce($arrayResultante, function ($resultado, $item) {
                $idMenu = $item['id_menu'];

                // Si el grupo aún no existe, créalo
                if (!isset($resultado[$idMenu])) {
                    $resultado[$idMenu] = [
                        'id_menu' => $idMenu,
                        'menu' => $item['menu'],
                        'submenus' => [],
                    ];
                }

                // Agrega el elemento al grupo
                $resultado[$idMenu]['submenus'][] = [
                    'id_submenu' => $item['id_submenu'],
                    'nombre_submenu' => $item['nombre_submenu'],
                    'id_submenu_hijos' => $item['id_submenu_hijos'],
                    'nombre_submenu_hijo' => $item['nombre_submenu_hijo'],
                ];

                return $resultado;
            }, []);

// Convierte el resultado de nuevo a un array
            $gruposPorMenu = array_values($gruposPorMenu);


            return response()->json($gruposPorMenu,200);
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }

    }



    public function listar_tipo_permisos_menu ($id_rol){
        $menu=  DB::table('configuracion.permisos as p')
            ->select('p.id_menu as id_menu')
            ->where('p.id_rol','=',$id_rol)
            ->where('p.eliminado','=','NO')
            ->where('p.activo','=','SI')
            ->whereNotNull('p.id_menu')
            ->pluck('id_menu');

        $menu = json_decode($menu,true);

        return $menu;

    }

    public function listar_tipo_permisos_submenu ($id_rol){
        $menu=  DB::table('configuracion.permisos as p')
            ->select('p.id_submenu as id_submenu')
            ->where('p.id_rol','=',$id_rol)
            ->where('p.eliminado','=','NO')
            ->where('p.activo','=','SI')
            ->whereNotNull('p.id_submenu')
            ->pluck('id_submenu');

        $menu = json_decode($menu,true);

        return $menu;

    }

    public function listar_tipo_permisos_submenuhijo ($id_rol){
        $menu=  DB::table('configuracion.permisos as p')
            ->select('p.id_submenuhijo as id_submenuhijo')
            ->where('p.id_rol','=',$id_rol)
            ->where('p.eliminado','=','NO')
            ->where('p.activo','=','SI')
            ->whereNotNull('p.id_submenuhijo')
            ->pluck('id_submenuhijo');



        $menu = json_decode($menu,true);

        return $menu;

    }

    public function listar_permisos (){
        $menu=  DB::table('configuracion.permis as p')
            ->select('p.id','p.nombre')
            ->get();



        $menu = json_decode($menu,true);

        return $menu;
    }

    public function validar_permiso_menu($id_menu,$id_permis,$id_rol){
        try {
            $menu=  DB::table('configuracion.permisos as p')
                ->select('p.id')
                ->where('p.id_rol','=',$id_rol)
                ->where('p.id_menu','=',$id_menu)
                ->where('p.id_permis','=',$id_permis)
                ->pluck('id');



            $menu = json_decode($menu,true);

            return $menu;
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function validar_permiso_submenu($id_submenu,$id_permis,$id_rol){
        try {
            $menu=  DB::table('configuracion.permisos as p')
                ->select('p.id')
                ->where('p.id_rol','=',$id_rol)
                ->where('p.id_submenu','=',$id_submenu)
                ->where('p.id_permis','=',$id_permis)
                ->pluck('id');



            $menu = json_decode($menu,true);

            return $menu;
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

    public function validar_permiso_submenuhijo($id_submenuhijo,$id_permis,$id_rol){
        try {
            $menu=  DB::table('configuracion.permisos as p')
                ->select('p.id')
                ->where('p.id_rol','=',$id_rol)
                ->where('p.id_submenuhijo','=',$id_submenuhijo)
                ->where('p.id_permis','=',$id_permis)
                ->pluck('id');

            $menu = json_decode($menu,true);

            return $menu;
        }catch (\Exception $e){
            return response()->json(['message' => 'Error en la operación', 'error' => $e->getMessage()], 500);
        }
    }

}
