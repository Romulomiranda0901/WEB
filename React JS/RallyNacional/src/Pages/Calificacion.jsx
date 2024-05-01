
// import React, { useState, useEffect } from 'react';
// import Grid from '@mui/material/Grid';
// import Paper from '@mui/material/Paper';
// import Box from '@mui/material/Box';
// import { createTheme, ThemeProvider, styled } from '@mui/material/styles';
// import styles from "../assets/css/Styles.module.css";
// import { DataGrid, GridActionsCellItem, GridToolbar } from '@mui/x-data-grid';
// import Dialog from '@mui/material/Dialog';
// import DialogActions from '@mui/material/DialogActions';
// import DialogContent from '@mui/material/DialogContent';
// import DialogTitle from '@mui/material/DialogTitle';
// import useMediaQuery from '@mui/material/useMediaQuery';
// import { useTheme } from '@mui/material/styles';
// import Button from '@mui/material/Button';

// import EditIcon from '@mui/icons-material/Edit';
// import TextField from '@mui/material/TextField';
// import Alert from '@mui/material/Alert';

// const Item = styled(Paper)(({ theme }) => ({
//   ...theme.typography.body2,
//   textAlign: 'center',
//   color: theme.palette.text.secondary,
//   height: 60,
//   lineHeight: '60px',
// }));

// const lightTheme = createTheme({ palette: { mode: 'light' } });

// export default function Calificacion() {
//   const [openEdit, setOpenEdit] = useState(false); //Abrir o cerrar modal de edicion
//     const [openCreate, setOpenCreate] = useState(false); ////Abrir o cerrar modal de agregar
//     const theme = useTheme();
//     const fullScreen = useMediaQuery(theme.breakpoints.down('md'));
//     const [id, setId] = useState(4544); //Consigue id de la institucion que se dea editar o eliminar
//     const [estado, setEstado] = useState(false); //Creado para renderizado automatico cada vez que se realice un cambio en la base de datos
//     const [rows, setRows] = React.useState([]); //Guarda la lista de instituciones
//     const [error, setError] = useState(''); 
//     const [showError, setShowError] = useState(false);
//     const [values, setValues] = useState({
//         id: 1,
//         nombreequipo: '',
//         sede:'',
//         municipio:'',
//         Calificacion:''

//       }); //Guarda los nuevos datos de la institucion, tanto para crear como editar


//       /* Eventos: Conseguir nuevo datos de la institucion */
//     const handleChange = (prop) => (event) => {
      
//         setShowError(false);
//         setValues({ ...values, [prop]: event.target.value });
      
//     };
//         /*Conseguir equipos */
//         useEffect(() => {
//           fetch('http://localhost:8000/api/equipos')
//             .then(r => r.json())
//             .then(equipo => setRows(equipo.data));
            
//         }, [estado]); //Se ejecuta cada vez que el Hook estado cambia de valor
//   console.log(rows);
    
//         /*** Editar ***/
  
//           /* Abrir modal de edicion y obtener datos actuales de la institucion a editar */
//           const handleClickOpenEdit = React.useCallback((idd) => (event) => {
//               setId(idd);
//               var u = rows.find(c => c.id === idd);
//               setValues({ id: idd, nombre: u.equipo}); //Se guardan los datos actuales del registro
  
//               setOpenEdit(true); //Abre modal de edicion
          
//           }, [rows],
//           );
  
//           /*Cerrar modal de edit */
//           const handleCloseEdit = () => {
//               setOpenEdit(false);
//             };
  
//           /*Envio de datos al backend para actualizar*/
//           const handleSubmitEdit = async (event) => {
//               event.preventDefault();
//               const equipo = values;
              
//               if(equipo['calificacion'].length < 0)
//               {
//                   setError('La calificacion ingresada no puede ser menor a cero');
//                   setShowError(true);
//               }
//               else {
//               setShowError(false);
//                   try{
//                       const response = await fetch(`http://localhost:8000/api/instituciones/${equipo['id']}`,{
//                           method: 'PUT',
//                           headers: { 'Content-Type': 'application/json' },
//                           body: JSON.stringify(equipo)
//                       });
//                       setEstado(!estado);
//                       setValues({ id: 1, nombre: "" }); //Se limpia
//                       setOpenEdit(false);
//                   }
//                   catch (error)
//                   {
//                       console.error(error);
//                   }
//               }
//           }
  
//         /*Definir columnas */
//       const columns = React.useMemo(
//           () => [
//             { field: 'id', type: 'number', width: 80 },
//             { field: 'nombre', type: 'string', headerName: "Nombre Equipo", width: 150},
//             { field: 'sede', type: 'string', headerName: "sede", width: 150},
//             { field: 'municipio', type: 'string', headerName: "Municipio", width: 150},
//             { field: 'calificacion', type: 'number', headerName: "Calificacion", width: 150},
//             {
//               field: 'actions',
//               type: 'actions',
//               width: 350,
//               getActions: (params) => [
//                   <GridActionsCellItem 
//                   icon={<EditIcon />} 
//                   label="Edit"
//                   onClick={handleClickOpenEdit(params.id)} />,
  
//               ],
//             },
//           ],
//           [handleClickOpenEdit],
//         );
  
//   return (

//                <div>
//             <div className={styles.contenedor}>
//                 <div>
//                     <h4>Gestion de Clificaciones</h4>
//                 </div>

//                 <div style={{ height: 350, width: '100%' }}>
//                 <DataGrid columns={columns} rows={rows} components={{
//                     Toolbar: GridToolbar,
//                     }} />
//                 </div>
//             </div>
//             <Dialog fullScreen={fullScreen} open={openEdit} onClose={handleCloseEdit} aria-labelledby="responsive-dialog-title">
//                 <form action="" onSubmit={(event) => handleSubmitEdit(event)}>
//                 <DialogTitle id="responsive-dialog-title">
//                     {"Calificar Equipo"}
//                 </DialogTitle>
//                 <DialogContent>
//                 {rows.filter(c => c.id === id).map( equipo => (
//                     <div key={equipo.id}>
//                         <div>
//                         {showError ? <Alert severity="error">{error}</Alert> : ""}
//                         </div>
//                         <div className={styles.contModalEdit}>
//                             <TextField id="standard-basic" onChange={handleChange('calificacion')} defaultValue={equipo.calificacion} label="Calificacion de proyecto" variant="standard" />
//                         </div>
//                     </div>
//                     ))}
//                 </DialogContent>
//                 <DialogActions>
//                 <Button autoFocus type="submit">
//                     Guardar
//                     </Button>
//                     <Button onClick={handleCloseEdit}>
//                     Cerrar
//                     </Button>
//                 </DialogActions>
//                 </form>
//             </Dialog>

//         </div>
//   );
// }

import React, { useState, useEffect} from "react";
import Listar from "../Components/Calificacion/listar";

export default function Calificacion() 
{
    return(
        <div>
            <Listar></Listar>
        </div>
    )
}
