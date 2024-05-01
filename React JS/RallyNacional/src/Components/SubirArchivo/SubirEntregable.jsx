import React, {useEffect, useState} from 'react';
import { Button, CardActionArea, CardActions, IconButton} from '@mui/material';
import {fetchData, fetchDataDepend, fetchDelete, fetchList, fetchList2} from "../../Libs/Fetch";
import axios from 'axios';
import Swal from "sweetalert2";
import {useNavigate} from "react-router-dom";


  const ArchivosG =() =>
{
  const [estado, setEstado] = useState(false);
  const [values, setValues] = useState({})
  const [Equipo, setEquipo] = useState([]);
  const [Desafio, setDesafio] = useState([]);
  const [Categoria, setCategoria] = useState([]);
  const [archivos, setArchivos] = useState(null);
    const navigate = useNavigate()
    useEffect(() => fetchList("equipo", setEquipo), [setEstado]);
    useEffect(() => fetchList("desafio", setDesafio), [setEstado]);
    useEffect(() => fetchList("criterios", setCategoria), [setEstado]);




  // se obtiene los valores de los input
  const handleChange = (event) => {
      const {target: { name, value },} = event;
      setValues((values) => ({ ...values, [name]: value }));
  };
  const handleChangeFile = (event) => {
    const {target: { name, value },} = event;
    setValues((values) => ({ ...values, [name]: event.target.files[0] }));
};

  console.log(values);



    function mandar(event){
        event.preventDefault()
        const token = sessionStorage.getItem('auth_token');
        const config = {
            headers: {
                'content-type': 'multipart/form-data',
                "Authorization": `Bearer ${token}`
            }
        };
        axios.post(`${process.env.REACT_APP_API_URL}/api/entregables/crear`, values, config)
            .then(response=>{
                console.log(response.data);
                Swal.fire(
                    'Rally Nacional',
                    'Datos Guardado Correctamente',
                    'success'
                )
                setValues({});
                event.target.reset();
            }).catch(error=>{
            console.log(error);
            Swal.fire(
                'Rally Nacional',
                error,
                'warning'
            )
        })



    }

  return (
    <div className="container-xxl flex-grow-1 container-p-y">
      <h4 className="fw-bold py-3 mb-6"><span className="text-muted fw-light">Subir Entregables</span></h4>

      <div className="card mb-4">
      <div className="card-header d-flex align-items-center justify-content-between">
        <h6 className="mb-0">Datos que los participantes deben entregar</h6>
      </div>
      {/* <form onSubmit={(event) => (event)}> */}
      <form onSubmit={mandar} method='POST' encType='multipart/form-data'>
        <div className="card-body row">
        <div className="col-md-12">
          <div className="row mb-3">
              
               <div className="col-sm-6">
              <label  className="form-label">Seleccione el nombre del equipo</label>
                  <div className="input-group input-group-merge">
                      <select className="form-select form-control" aria-label="Default select example" name='equipo_id' id='equipo_id' defaultValue={''}   required onChange={handleChange} >
                          <option value={''} disabled="disabled">Seleccione el equipo</option>
                            {Equipo.map((equipo) => {
                            return (
                          <option key={equipo.id} value={equipo.id}>
                            {equipo.nombre}
                          </option>
                          );
                          })}

                      </select>
                    </div>
                </div>
                
                
                <div className="col-sm-6 mb-3">
              <label  className="form-label">Seleccione el desafio</label>
                  <div className="input-group input-group-merge">
                      <select className="form-select form-control" aria-label="Default select example" name='desafio_id' id='desafio_id' defaultValue={''}   required  onChange={handleChange}  >
                          <option value={''} disabled="disabled">Seleccione el desafio</option>
                            {Desafio.map((reg) => {
                            return (
                          <option key={1} value={1}>
                            {reg.nombre}
                          </option>
                          );
                          })}

                      </select>
                    </div>
                </div>

              <div className="col-sm-6 mb-3">
                  <label  className="form-label">Seleccione la Categoria</label>
                  <div className="input-group input-group-merge">
                      <select className="form-select form-control" aria-label="Default select example" name='criterio_id' id='criterio_id' defaultValue={''}   required  onChange={handleChange}  >
                          <option value={''} disabled="disabled">Seleccione el desafio</option>
                          {Categoria.map((reg) => {
                              return (
                                  <option key={1} value={1}>
                                      {reg.nombre}
                                  </option>
                              );
                          })}

                      </select>
                  </div>
              </div>

                <div className="col-sm-6 mb-3">
                  <label  className="form-label">Seleccione el tipo de documento</label>
                  <div className="input-group input-group-merge">
                      <select className="form-select form-control" aria-label="Default select example" name='tipo_archivo_id' id='tipo_archivo_id' defaultValue={''}   required  onChange={handleChange} >
                          <option value={''} disabled="disabled">Seleccione el tipo</option>
                            
                            return (
                          <option key={1} value={1}>
                            {'Pdf'}
                          </option>
                          );

                      </select>
                    </div>
                </div>

                <div className="col-sm-6 mb-3">
                  <label  className="form-label">Descripcion</label>
                  <input type="text" className="form-control" id="descripcion" name='descripcion'
                  placeholder="Descripcion"   required  onChange={handleChange} />
                </div>
              <div className='col-sm-6'>
                  <label  className="form-label">Ingrese el link de youtube</label>
                  <input type="text" className="form-control" id="link" name='link'
                         placeholder="Ingrese en link de youtube"   required  onChange={handleChange} />
              </div>
          </div>


          <div className='row mb-3'>
          <input type="file" name='urlpdf' id='urlpdf' required onChange={handleChangeFile} />
          </div>
          <div>
          <Button variant="contained" color="primary" autoFocus type="submit" >
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