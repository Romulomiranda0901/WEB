import React, {useEffect, useState} from 'react';
import { Button, CardActionArea, CardActions, IconButton} from '@mui/material';
import {fetchData, fetchDataDepend, fetchDelete, fetchList, fetchList2} from "../../Libs/Fetch";
import axios from 'axios';

const ArchivosG =() =>
{
  const [estado, setEstado] = useState(false);
  const [values, setValues] = useState({})
  const [evento, setEvento] = useState([]);
  const [archivos, setArchivos] = useState(null);


  const insertarArchivos=async()=>{
    const f = new FormData();
    
    for (let index = 0; index < archivos.length; index ++){
      f.append("files", archivos[index]);
    }
    console.log(f)
    await axios.post("http://localhost:8000/api/archivosg/crear", values)
    .then(response=>{
      console.log(response.data);
    }).catch(error=>{
      console.log(error);
    })
  }

  // se obtiene los valores de los input
  const handleChange = (event) => {
      const {target: { name, value },} = event;
      setValues((values) => ({ ...values, [name]: value }));
  };
  const handleChangeFile = (event) => {
    const {target: { name, value },} = event;
    setValues((values) => ({ ...values, [name]: event.target.files[0] }));
};
  useEffect(() => fetchList("evento", setEvento), [setEstado]);

  function mandar(event){
    event.preventDefault()
      const token = sessionStorage.getItem('auth_token');
    const config = {
      headers: {
        'content-type': 'multipart/form-data',
          "Authorization": `Bearer ${token}`
      }
    };
    axios.post(`${process.env.REACT_APP_API_URL}/api/archivosg/crear`, values, config)
    .then(response=>{
      console.log(response.data);
    }).catch(error=>{
      console.log(error);
    })



  }
  

  return(
    <div className="container-xxl flex-grow-1 container-p-y">
     <h4 className="fw-bold py-3 mb-4"><span className="text-muted fw-light">Archivos Generales</span></h4>
     <div className="card mb-4">
      <div className="card-header d-flex align-items-center justify-content-between">
        <h6 className="mb-0">Requisitos para los Participantes</h6>
      </div>
      {/* <form onSubmit={(event) => (event)}> */}
      <form onSubmit={mandar} method='POST' encType='multipart/form-data'>
        <div className="card-body row">
        <div className="col-md-6">
          <div className="row mb-3">
              <label  className="form-label">Seleccione el Evento</label>
              <div className="col-sm-10">
                  <div className="input-group input-group-merge">
                      <select className="form-select form-control" aria-label="Default select example" name='evento_id' id='evento_id' defaultValue={''}   onChange={handleChange} required >
                          <option value={''} disabled="disabled">seleccione el evento</option>
                            {evento.map((reg) => {
                            return (
                          <option key={reg.id} value={reg.id}>
                            {reg.nombre}
                          </option>
                          );
                          })}

                      </select>
                    </div>
                </div>
          </div>
          <div className='col mb-5'>
          <input type="text" className="form-control" id="descripcion" name='descripcion'  onChange={handleChange}
                 placeholder="Descripcion del Archivo"   required/>
          </div>
          <div className='row mb-3'>
          <input type="file" name='urlpdf1' id='urlpdf1' onChange={handleChangeFile}/>
          </div>
          <div>
          <Button variant="contained" color="primary" autoFocus type="submit">
               Subir Archivos
           </Button>
           </div>
        </div>
        </div>
      </form>
     </div>
    </div>
  )
}
export default ArchivosG;