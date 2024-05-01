import React, { useState, useEffect } from 'react';
import styles from "../assets/css/Styles.module.css";
import { DataGrid, GridActionsCellItem, GridToolbar } from '@mui/x-data-grid';
import Dialog from '@mui/material/Dialog';
import DialogActions from '@mui/material/DialogActions';
import DialogContent from '@mui/material/DialogContent';
import DialogTitle from '@mui/material/DialogTitle';
import useMediaQuery from '@mui/material/useMediaQuery';
import { useTheme } from '@mui/material/styles';
import Button from '@mui/material/Button';
//import { authFetch } from '../Libs/Auth';
import DeleteIcon from '@mui/icons-material/Delete';
import EditIcon from '@mui/icons-material/Edit';
import TextField from '@mui/material/TextField';
import AddIcon from '@mui/icons-material/Add';
import ToggleButton from '@mui/material/ToggleButton';
import Alert from '@mui/material/Alert';
import Visibility from '@mui/icons-material/Visibility';

export function Descargas()
{
    /*Hooks*/
    const [openEdit, setOpenEdit] = useState(false); //Abrir o cerrar modal de edicion
    const [openCreate, setOpenCreate] = useState(false); ////Abrir o cerrar modal de agregar
    const theme = useTheme();
    const fullScreen = useMediaQuery(theme.breakpoints.down('md'));
    const [id, setId] = useState(4544); //Consigue id de la institucion que se dea editar o eliminar
    const [estado, setEstado] = useState(false); //Creado para renderizado automatico cada vez que se realice un cambio en la base de datos
    const [rows, setRows] = React.useState([]); //Guarda la lista de datos
    const [error, setError] = useState(''); 
    const [showError, setShowError] = useState(false);
    const [values, setValues] = useState({
        id: 1,
        nombre: '',
        descripcion: '',
        archivo: ''
      }); //Guarda los nuevos datos, tanto para crear como editar


      /* Eventos: Conseguir nuevo dsatos */
    const handleChange = (prop) => (event) => {
      
        setShowError(false);
        setValues({ ...values, [prop]: event.target.value });
      
    };

    /*Conseguir los datos */
    useEffect(() => {
        fetch('http://localhost:8000/api/descargas')
          .then(r => r.json())
          .then(descargas => setRows(descargas.data)); 
          console.log('Se consiguen de nuevo los datos');
      }, [estado]); //Se ejecuta cada vez que el Hook estado cambia de valor
console.log(rows);

      /*** Crear ***/

      /*Abrir modal para crear */
      const handleClickOpenCreate = () => {
      
        setOpenCreate(true);
    
      };

      /* Cerrar modal de crear */
      const handleCloseCreate = () => {
        setOpenCreate(false);
      };

      /* Enviar los datos del nuevo registro al backend */
        const handleSubmitCreate = async (event) => {
            event.preventDefault();
            const archivo = values;
            delete archivo['id'];
            console.log(archivo['nombre']);
            if(archivo['nombre'].length < 3){ /** <= Cambiar validacion  */
                setError('El nombre del archivo debe contener al menos 3 caracteres');
                setShowError(true);
            }
            else 
            {
                setShowError(false);
            
                try{


                    const response = await fetch('http://localhost:8000/api/descargas',{
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(archivo)

                    });

                    setEstado(!estado);
                    setValues({ id: 1, nombre: "", descripcion: "", archivo: "" })
                    setOpenCreate(false);
                }catch (error)
                {
                    console.error(error);
                }
            }
        }

      /*** Editar ***/

        /* Abrir modal de edicion y obtener datos actuales de la institucion a editar */
        const handleClickOpenEdit = React.useCallback((idd) => (event) => {
            setId(idd);
            var u = rows.find(c => c.id === idd);
            setValues({ id: idd, nombre: u.nombre, descripcion: u.descripcion, archivo: u.archivo }); //Se guardan los datos actuales del registro

            setOpenEdit(true); //Abre modal de edicion
        
        }, [rows],
        );

        /*Cerrar modal de edit */
        const handleCloseEdit = () => {
            setOpenEdit(false);
          };

        /*Envio de datos al backend para actualizar*/
        const handleSubmitEdit = async (event) => {
            event.preventDefault();
            const archivo = values;
            
            if(archivo['nombre'].length < 3)
            {
                setError('El nombre de la institución debe contener al menos 3 caracteres');
                setShowError(true);
            }
            else {
            setShowError(false);
                try{
                    const response = await fetch(`http://localhost:8000/api/instituciones/${archivo['id']}`,{
                        method: 'PUT',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(archivo)
                    });
                    setEstado(!estado);
                    console.log(estado);
                    setValues({ id: 1, nombre: "", descripcion: "", archivo: "" }); //Se limpia
                    setOpenEdit(false);
                    
                }
                catch (error)
                {
                    console.error(error);
                }
            }
        }

        /*** Eliminar ***/
        const handleClickDelete = React.useCallback((idd) => async () => {
            setId(idd);
            const archivo = values;

      
            const response = await fetch('http://localhost:8000/api/descargas/' + idd,{
                method: 'Delete',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(archivo)
            })
              .then(r => r.json())
              .then(m => {});
              setEstado(!estado);
            
        }, [estado, values]
        );


      /*Definir columnas */
    const columns = React.useMemo(
        () => [
          { field: 'id', type: 'number', width: 80 },
          { field: 'nombre', type: 'string', headerName: "Nombre", width: 150},
          { field: 'descripcion', type: 'string', headerName: "Descripcion", width: 400},
          {
            field: 'actions',
            type: 'actions',
            width: 120,
            getActions: (params) => [
                <GridActionsCellItem 
                icon={<Visibility />} 
                label="Show"
                onClick={handleClickOpenEdit(params.id)} />,

                <GridActionsCellItem 
                icon={<EditIcon />} 
                label="Edit"
                onClick={handleClickOpenEdit(params.id)} />,

                <GridActionsCellItem 
                icon={<DeleteIcon />} 
                label="Delete"
                onClick={handleClickDelete(params.id)} />,
            ],
          },
        ],
        [handleClickOpenEdit, handleClickDelete],
      );

    return(
        <div>
            <div className={styles.contenedor}>
                <div>
                    <h4>Gestión de Zona de Descargas</h4>
                </div>

                <div className={styles.ContNuevo}>
                <ToggleButton value="Add" onClick={handleClickOpenCreate}>
                    <AddIcon />
                </ToggleButton>
                </div>

                <div style={{ height: 350, width: '100%' }}>
                <DataGrid columns={columns} rows={rows} components={{
                    Toolbar: GridToolbar,
                    }} />
                </div>
            </div>

            <Dialog fullScreen={fullScreen} open={openCreate} onClose={handleCloseCreate} aria-labelledby="responsive-dialog-title">
                <form action="" onSubmit={(event) => handleSubmitCreate(event)}>

                <DialogTitle id="responsive-dialog-title">
                    {"Agregar Institución"}
                </DialogTitle>
                <DialogContent>
                    <div>
                    {showError ? <Alert severity="error">{error}</Alert> : ""}
                    </div>
                    <div className={styles.contModalEdit}>
                        <TextField id="standard-basic" onChange={handleChange('nombre')} label="Nombre de institución" variant="standard" />
                    </div>
                </DialogContent>
                <DialogActions>
                <Button autoFocus type="submit">
                    Guardar
                    </Button>
                    <Button onClick={handleCloseCreate}>
                    Cerrar
                    </Button>
                </DialogActions>
                </form>
            </Dialog>


            <Dialog fullScreen={fullScreen} open={openEdit} onClose={handleCloseEdit} aria-labelledby="responsive-dialog-title">
                <form action="" onSubmit={(event) => handleSubmitEdit(event)}>
                <DialogTitle id="responsive-dialog-title">
                    {"Editar Institución"}
                </DialogTitle>
                <DialogContent>
                {rows.filter(c => c.id === id).map( institucion => (
                    <div key={institucion.id}>
                        <div>
                        {showError ? <Alert severity="error">{error}</Alert> : ""}
                        </div>
                        <div className={styles.contModalEdit}>
                            <TextField id="standard-basic" onChange={handleChange('nombre')} defaultValue={institucion.nombre} label="Nombre de institución" variant="standard" />
                        </div>
                    </div>
                    ))}
                </DialogContent>
                <DialogActions>
                <Button autoFocus type="submit">
                    Guardar
                    </Button>
                    <Button onClick={handleCloseEdit}>
                    Cerrar
                    </Button>
                </DialogActions>
                </form>
            </Dialog>

        </div>
    )
}