import React, { useState, useEffect } from 'react'
import axios from 'axios'
import { Button, CardActionArea, CardActions, IconButton} from '@mui/material';
import 'bootstrap/dist/css/bootstrap.min.css';
import Card from 'react-bootstrap/Card'
import Row from 'react-bootstrap/Row'
import Col from 'react-bootstrap/Col'

import SubirEntregables from "../Components/SubirArchivo/SubirEntregable"

function Entregables() {

    // eslint-disable-next-line react-hooks/rules-of-hooks
    const [archivos, setArchivos]=useState(null);
    const subirArchivos=e=>{
      setArchivos(e);
    }
    const insertarArchivos=async()=>{
      const f= new FormData();

      for (let index = 0; index < archivos.length; index++){
        f.append("files",archivos[index]);  
      }
      await axios.post("http://localhost:3000/api/upload", f)
      .then(response=>{
        console.log(response.data);
      }).catch(error=>{
        console.log(error);
      })
    }

    return (
        <div className='App'>

            <div>
              <h4>Gestion de Archivos</h4></div>
      <div>
        <div>
          <SubirEntregables></SubirEntregables>
        </div>
        {/* <Card>
        <Card.Header>Archivos Generales</Card.Header>
  <Card.Body>
    <Card.Title>Requisitos para Inscripción</Card.Title>
    <Card.Text>
    Seleccione los Archivos deseados para mostrar en descargas.
    </Card.Text>
    <input type="file" name='files' multiple onChange={(e)=>subirArchivos(e.target.files)}/>
    <br /> <br />
    <div>
    <Button variant="contained" color="primary" onClick={()=>insertarArchivos()}>
               Subir Archivos
           </Button>
           </div>
  </Card.Body>
        </Card> */}
      </div>
    </div>       
    )
}
export default Entregables;
