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
import ActualizarSedes from "../Sedes/actualizarSedes";
import {FaTrash} from "react-icons/fa";


export default function Modalsponsor() {
    const [open, setOpen] = React.useState(false);

  const handleClickOpen = () => {
    setOpen(true);
  };

  const handleClose = () => {
    setOpen(false);
  };

// listados de patrocinadores

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
      useEffect(() => fetchList2("public/listar_patrocinador", setRows), [estado]);


  
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
  dataField: 'logo',
  text:'Logo',
   formatter: iconPatrociandor

},
];

    function iconPatrociandor(cell, row, rowIndex, formatExtraData)
    {
        console.log(row);

        return (

            <div className='row justify-content-center row-cols-2 row-cols-lg-5 g-2 g-lg-3'>
                <div className="col "><img src={`${process.env.REACT_APP_API_URL}/${row.logo}`} /></div>
            </div>
        );
    }


  return (
    <div>
        <Button variant="contained" color="secondary" onClick={handleClickOpen}>
       Ver lista de Patrocinadores
      </Button>
      <Dialog
        open={open}
        onClose={handleClose}
        aria-labelledby="alert-dialog-title"
        aria-describedby="alert-dialog-description"
        sm={{ mt: 1, Width: 180 }}
      >
        <DialogTitle id="alert-dialog-title" variant='success'>
          {"Listado de Nuestros Patrocinadores Oficiales"}
        </DialogTitle>
        <DialogContent>
          <DialogContentText id="alert-dialog-description" variant='contained'>
          </DialogContentText>
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
