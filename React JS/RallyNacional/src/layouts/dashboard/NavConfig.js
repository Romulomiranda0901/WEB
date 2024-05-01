// component
import Iconify from '../../Components/Iconify';

// ----------------------------------------------------------------------

const getIcon = (name) => <Iconify icon={name} width={28} height={28} />;
 function NavConfig (user)
 {
     let rol = user.roles.rol[0].rol

     let navConfig =[];

     switch (rol)
     {
         case 'admin':
             navConfig =    [
                 {
                     title: 'Inicio',
                     path: '/dashboard/app',
                     icon: getIcon('eva:pie-chart-2-fill'),
                 },
                 {
                     title: 'Gestion de Usuarios',
                     path: '/dashboard/user',
                     icon: getIcon('eva:people-fill'),
                 },
                 {
                     title: 'Gestion de Instituciones',
                     path: '/dashboard/instituciones',
                     icon: getIcon('gridicons:institution'),
                 },
                 {
                     title: 'Gestion de Sedes',
                     path: '/dashboard/sedes',
                     icon: getIcon('fa-solid:school'),
                 },

                 {
                     title: 'Inscripcion de Sedes',
                     path: '/dashboard/registrosedes',
                     icon: getIcon('fa-solid:school'),
                 },
                 {
                     title: 'Categorias',
                     path: '/dashboard/categoriaspremios',
                     icon: getIcon('ic:baseline-category'),
                 },
                 {
                     title: 'Desafio',
                     path: '/dashboard/desafios',
                     icon: getIcon('ic:baseline-category'),
                 },
                 {
                     title: 'Inscripcion de Equipos',
                     path: '/dashboard/inscripciones',
                     icon: getIcon('dashicons:media-document'),
                 },
                 {
                     title: 'Evaluacion',
                     path: '/dashboard/calificacion',
                     icon: getIcon('healthicons:i-exam-qualification'),
                 },
                 {
                     title: 'Subir Archivos',
                     path: '/dashboard/upload',
                     icon: getIcon('fa-solid:file-upload'),
                 },
                 {

                     title: 'Patrocinadores',
                     path:'/dashboard/patrocinadores',
                     icon: getIcon('fontisto:train-ticket'),
                 }
             ]
             break;

         case 'comite':

             navConfig = [
                 {
                     title: 'Inicio',
                     path: '/dashboard/app',
                     icon: getIcon('eva:pie-chart-2-fill'),
                 },
                 {
                     title: 'Inicio',
                     path: '/dashboard/app',
                     icon: getIcon('eva:pie-chart-2-fill'),
                 },

                 {
                     title: 'Gestion de Sedes',
                     path: '/dashboard/sedes',
                     icon: getIcon('fa-solid:school'),
                 },

                 {
                     title: 'Inscripcion de Sedes',
                     path: '/dashboard/registrosedes',
                     icon: getIcon('fa-solid:school'),
                 },
                 {
                     title: 'Categorias',
                     path: '/dashboard/categoriaspremios',
                     icon: getIcon('ic:baseline-category'),
                 },
                 {
                     title: 'Desafio',
                     path: '/dashboard/desafios',
                     icon: getIcon('ic:baseline-category'),
                 },

                 {
                     title: 'Evaluacion',
                     path: '/dashboard/calificacion',
                     icon: getIcon('healthicons:i-exam-qualification'),
                 }

             ]
             break;

         case 'coordinador_sede':
             navConfig = [
                 {
                     title: 'Inicio',
                     path: '/dashboard/app',
                     icon: getIcon('eva:pie-chart-2-fill'),
                 },
                 {
                     title: 'Inscripcion de Sedes',
                     path: '/dashboard/registrosedes',
                     icon: getIcon('fa-solid:school'),
                 },
                 {
                     title: 'Inscripcion de Equipos',
                     path: '/dashboard/inscripciones',
                     icon: getIcon('dashicons:media-document'),
                 },

                 {
                     title: 'Evaluacion',
                     path: '/dashboard/calificacion',
                     icon: getIcon('healthicons:i-exam-qualification'),
                 }

             ]
             break;

         case 'equipo':
             navConfig =[
                 {

                 }
             ]
             break;



     }

     return navConfig;
 }



export default NavConfig;
