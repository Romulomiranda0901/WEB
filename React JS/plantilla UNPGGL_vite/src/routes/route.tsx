//import React from 'react'; // Importa React

// Importa los componentes necesarios
import Welcome from '../pages/Welcome';
import Login from '../pages/Login';
import Register from '../pages/Register';
import BaseDashBoard from '../pages/layout/BaseDashBoard';
import Cliente from '../pages/Cliente.tsx';
import precios from "../pages/Precios.tsx";
import Precios from "../pages/Precios.tsx";

// Define el tipo de ruta
type RouteType = {
    path: string;
    element: any; // Agrega un punto y coma aquí
    isProtected?: boolean;
    children?: RouteType[];
};


// Define las rutas de la aplicación
export const routes : RouteType[]  = [
   /* {
        path: '/welcome',
        element: Welcome,
      //  isProtected: true,
    },*/
    {
        path: '/',
        element: Login,
    },
    {
        path: '/dashboard',
        element: BaseDashBoard,
        isProtected: true,
        children: [
        ],
    },
    {
        path: '/dashboard/cliente',
        element: Cliente,
        isProtected: true,
    },
    {
        path: '/dashboard/precio',
        element: Precios,
        isProtected: true,
    },
];