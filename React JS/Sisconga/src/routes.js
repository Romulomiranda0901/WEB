import { useRoutes } from 'react-router-dom';
import Dashboard from "./page/DashboardApp";
import Login from "./page/Login";
import DefaultLayout from "./layouts/Default"
import PageRecibos from "./page/Tesoreria/Recibos/PageRecibos";
import NuevoRecibo from "./page/Tesoreria/Recibos/NuevoRecibo";
import ReciboImprimir from "./components/Tesoreria/Recibos/ReciboImprimir";


export default function Router()
{
    return useRoutes([
        {
            path: '/dashboard',
            element: <Dashboard/>,
        },
        {
            path: '/login',
            element: <Login/>,
        },
        {
            path:'/dashboard',
            element: <DefaultLayout/>,
            children:[
                { path: 'Recibos', element: <PageRecibos /> },

            ]

        },
        {
            path:'/tesoreria',
            element: <DefaultLayout/>,
            children:[
                { path: 'NuevoRecibo', element: <NuevoRecibo /> },
                {path: 'Recibo', element: <ReciboImprimir/>}

            ]
        }

    ])
}