import React, {useEffect, useState} from 'react'
import Button from '@mui/material/Button';
import Dialog from '@mui/material/Dialog';
import DialogActions from '@mui/material/DialogActions';
import DialogContent from '@mui/material/DialogContent';
import DialogContentText from '@mui/material/DialogContentText';
import DialogTitle from '@mui/material/DialogTitle';
import { makeStyles, IconButton, Tooltip} from '@mui/material';
import GetAppIcon from '@mui/icons-material/GetApp';
import {fetchData, fetchDataDepend, fetchDelete, fetchList, fetchList2} from "../../Libs/Fetch";
import {downloadPdf} from "../../Libs/SubirArchivo";
import BootstrapTable from 'react-bootstrap-table-next';
import paginationFactory from 'react-bootstrap-table2-paginator';
import { FaDownload, FaTrash } from 'react-icons/fa';
import axios from "axios";

   // Descargas
   const initialvalues = {
    archivo: null,
    archivoNombre: '',
    archivoURL: ''
  }

export default function ModalDescarga() {

    // Modal
    const [open, setOpen] = React.useState(false);

    const handleClickOpen = () => {
      setOpen(true);
    };
  
    const handleClose = () => {
      setOpen(false);
    };

    // Descargas
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
      useEffect(() => fetchList2("public/listar_archivo", setRows), [estado]);
      const download = (url1, name) =>
      {
          axios({
              url: `${process.env.REACT_APP_API_URL}/api/public/download/${url1}`,
              method: 'GET',
              responseType:'blob',

          }).then((response) =>{
            // console.log(response.data);
              const url = window.URL.createObjectURL( new Blob([response.data]))

              const link =document.createElement('a');
              link.href = url;
              link.setAttribute('download', 'file.pdf')
              link.click();
          })
      }
  
      const rowActual =(row) =>{
          setRow(row);
      }
      function iconAcion(cell, row, rowIndex, formatExtraData)
    {


          return (

            <div className='row justify-content-center row-cols-2 row-cols-lg-5 g-2 g-lg-3'>
                <div className="col ">
                <Tooltip title="Descargar Archivos">
                  <button onClick={() =>download(row.url,row.name)} className='btn btn-bg-primary'><FaDownload />
                  </button>
                </Tooltip> 
                  </div>
            </div>
    );
    }
  
const columns = [
 {
//   dataField: 'id',
//   text: ' #'
// }, {
  dataField: 'nombre',
  text: 'Nombre'
}, {
  dataField: 'descripcion',
  text:'Descripcion'
},{
  // dataField:'url',
  // text:'Archivo'
  dataField: 'Aciones',
        text: 'Descargar',
        formatter: iconAcion
}
];


  return (
    <div>
        <Button variant="contained" color='info' onClick={handleClickOpen}>
      Archivos Descargables
    </Button>
    <Dialog
      open={open}
      onClose={handleClose}
      aria-labelledby="alert-dialog-title"
      aria-describedby="alert-dialog-description"
    >
      <DialogTitle id="alert-dialog-title">
        {"Archivos Descargables para participar en la competencia."}
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
