import React, {useEffect, useState} from 'react'
import Button from '@mui/material/Button';
import Dialog from '@mui/material/Dialog';
import DialogActions from '@mui/material/DialogActions';
import DialogContent from '@mui/material/DialogContent';
import DialogContentText from '@mui/material/DialogContentText';
import DialogTitle from '@mui/material/DialogTitle';
import BootstrapTable from 'react-bootstrap-table-next';
import paginationFactory from 'react-bootstrap-table2-paginator';
import {fetchData, fetchDataDepend, fetchDelete, fetchList, fetchList2} from "../../Libs/Fetch";

export default function Modalinstituciones() {
    const [open, setOpen] = React.useState(false);

    const handleClickOpen = () => {
      setOpen(true);
    };
  
    const handleClose = () => {
      setOpen(false);
    };


    // LISTADO DE INSTITUCIONES

    // eslint-disable-next-line react-hooks/rules-of-hooks
    const [rows, setRows] = useState([]); //Guarda la lista de instituciones
    // eslint-disable-next-line react-hooks/rules-of-hooks
    const [estado, setEstado] = useState(false);
    // eslint-disable-next-line react-hooks/rules-of-hooks
    const [currentPage, SetcurrentPage] =  useState(1);
    // eslint-disable-next-line react-hooks/rules-of-hooks
    const [todosPerPage, SettodosPerPage] =  useState(1);
    // eslint-disable-next-line react-hooks/rules-of-hooks
    const [row1,setRow] =useState({});
    
      // eslint-disable-next-line react-hooks/rules-of-hooks
      useEffect(() => fetchList2("public/listar", setRows), [estado]);


  
      const rowActual =(row) =>{
          setRow(row);
  
  
      }
  
const columns = [
 {
//   dataField: 'id',
//   text: ' #'
// }, {
  dataField: 'nombre',
  text: 'Nombre'
}, {
  dataField: 'abreviacion',
  text:'Abreviación'

},
];

  return (
    <div>
    <Button variant="contained" color='warning' onClick={handleClickOpen}>
      Ver Listado de Instituciones
    </Button>
    <Dialog
      open={open}
      onClose={handleClose}
      aria-labelledby="alert-dialog-title"
      aria-describedby="alert-dialog-description"
    >
      <DialogTitle id="alert-dialog-title">
        {"Listado de las Instituciones Participantes"}
      </DialogTitle>
      <DialogContent>
        <DialogContentText id="alert-dialog-description">
        
        </DialogContentText>
        
        <hr />
                            <BootstrapTable
        
                                headerWrapperClasses="table-light "
                                keyField='id'
                                data={ rows }
                                columns={ columns }
                                hover
                                noDataIndication=" No hay Datos "
                                insertRow={true}
                                deleteRow={true}
                                pagination={ paginationFactory() }

                            />
      </DialogContent>
      <DialogActions>
        <Button onClick={handleClose} autoFocus>
          Cerrar
        </Button>
      </DialogActions>
    </Dialog>
  </div>
  )
}
