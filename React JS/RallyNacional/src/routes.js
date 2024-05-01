import { useRoutes } from 'react-router-dom';
// layouts
import DashboardLayout from './layouts/dashboard';
// //
import Instituciones from '../src/Pages/Instituciones';
import Sedes from '../src/Pages/Sedes'
import Inscripciones from '../src/Pages/Incripcion'
import Upload from '../src/Pages/upload'
import Calificacion from '../src/Pages/Calificacion';
import CategoriasPremios from '../src/Pages/CategoriasPremios'
import DashboardApp from '../src/Pages/DashboardApp';
import User from '../src/Pages/User';
import Home from '../src/Pages/Home'
import Patrocinadores from '../src/Pages/Patrocinadores';
import RegistrarSede from "./Pages/RegistroSede";
import FormInscricionSedes from "./Components/RegistraSede/FormInscricionSedes";
import IniciarSeccion from "./Pages/IniciarSeccion";
import Registrarse from "./Pages/RegistrarSesion";
import Desafio from "./Pages/Desafio";
import Forbidden from "./Components/Forbidden/Forbidden";
import Entregables from "./Pages/Entregables";
import Nuevo from "./Components/Patrocinadores/Nuevo";
import CalificacionNacional from "./Pages/CalificacionNacional"
// import { HeaderHome } from './Components/HeaderHome';
// import { Header } from './Components/Header';
// import { Home } from '@mui/icons-material';


// ----------------------------------------------------------------------

export default function Router() {
  return useRoutes([
    {
      path: '/',
      element: <Home />,
    },
    {
      path: '/inicio',
      element: <Home />,
    },
    {
      path: '/login',
      element: <IniciarSeccion/>,
    },
    {
      path: '/forbidden',
      element: <Forbidden />,
      path: '/RegistroCuenta',
      element: <Registrarse/>,
    },
    {

      path: '/dashboard',
      element: <DashboardLayout />,
      children: [
        { path: 'app', element: <DashboardApp /> },
        { path: 'user', element: <User/>},
        { path: 'instituciones', element: <Instituciones /> },
        { path: 'sedes', element: <Sedes /> },
        { path: 'registrosedes', element: <RegistrarSede /> },
        { path: 'inscripcionessedes', element: <FormInscricionSedes /> },
        { path: 'inscripciones', element: <Inscripciones /> },
        { path: 'upload', element: <Upload /> },
        { path: 'entregables', element: <Entregables /> },
        { path: 'calificacion', element: <Calificacion/>},
        { path: 'categoriaspremios', element: <CategoriasPremios /> },
        { path: 'patrocinadores', element: <Patrocinadores/>},
        { path: 'desafios', element: <Desafio/>},
        { path: 'crearPatrocinador', element: <Nuevo /> },
        { path: 'calificacionnacional', element: <CalificacionNacional/>},

      ],
    },

  ]);
}
