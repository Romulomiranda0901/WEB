//import React from 'react'; // Importa React

// Importa los componentes necesarios
import Welcome from '../pages/Welcome';
import Login from '../pages/Login';
import Register from '../pages/Register';
import BaseDashBoard from '../pages/layout/BaseDashBoard';
import Customers from '../pages/Customers';

// Define el tipo de ruta
type RouteType = {
    path: string;
    element: any; // Agrega un punto y coma aquí
    isProtected?: boolean;
    children?: RouteType[];
};


// Define las rutas de la aplicación
export const routes : RouteType[]  = [
    {
        path: '/welcome',
        element: Welcome,
        isProtected: true,
    },
    {
        path: '/',
        element: Login,
    },
    {
        path: '/register',
        element: Register,
        isProtected: true,
    },
    {
        path: '/dashboard',
        element: BaseDashBoard,
        isProtected: true,
        children: [
            {
                path: '', // La ruta vacía corresponde a '/dashboard'
                element: Customers,
            },
        ],
    },
];