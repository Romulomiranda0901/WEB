import React, {useEffect, useState} from "react";
import 'bootstrap/dist/css/bootstrap.min.css';
import {Modal, Button} from 'react-bootstrap';
import { FaPlusSquare,FaEye} from "react-icons/fa";
import {fetchData,fetchDataDepend,fetchList} from "../../Libs/Fetch";
import axios from 'axios';


const ModalAgregarDesafio =() =>
{
  const [estado, setEstado] = useState(false);
  const [values, setValues] = useState({})
  const [categoria, setCategoria] = useState([]);
  const [evento, setEvento] = useState([]);
  const [patrocinador, setPatrocinador] = useState([]);

  const [show, setShow] = useState(false);
    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);
    

    const handleChange = (event) => {

        const {target: { name, value },} = event;
        setValues((values) => ({ ...values, [name]: value }));
    };

    useEffect(() => fetchList("categorias", setCategoria), [setEstado]);
    useEffect(() => fetchList("evento", setEvento), [setEstado]);
    useEffect(() => fetchList("patrocinador", setPatrocinador), [setEstado]);


    function mandar(event){
        event.preventDefault()
          const token = sessionStorage.getItem('auth_token');
        const config = {
          headers: {
            'content-type': 'multipart/form-data',
              "Authorization": `Bearer ${token}`
          }
        };
        axios.post(`${process.env.REACT_APP_API_URL}/api/desafio/crear`, values, config)
        .then(response=>{
          console.log(response.data);
            window.location.reload();
            handleClose();
        }).catch(error=>{
          console.log(error);
        })
    
    
    
      }




    return (
      <div>
          <Button  className='btn btn-primary' onClick={handleShow}>
              <FaPlusSquare/>
          </Button>

          <Modal show={show} onHide={handleClose} centered>
              <Modal.Header closeButton>
                  <Modal.Title>Desafio</Modal.Title>
              </Modal.Header>
              <form onSubmit={mandar} method='POST' encType='multipart/form-data'>
                  <Modal.Body className="row g-3">
                          <div className="col-md-6">
                              <label htmlFor="inputEmail4" className="form-label">Categorias</label>
                              <select className="form-select" aria-label="Default select example" name='categoria_id' id='categoria_id' defaultValue={0} onChange={handleChange} >
                                  <option value={0} disabled="disabled">seleccione la categoria</option>
                                  {categoria.map((inst) => {
                                      return (
                                          <option key={inst.id} value={inst.id}>
                                              {inst.nombre}
                                          </option>
                                      );
                                  })}
                              </select>
                          </div>
                          <div className="col-md-6">
                              <label htmlFor="inputPassword4" className="form-label">Evento</label>
                              <select className="form-select" aria-label="Default select example" name='evento_id' id='evento_id' defaultValue={0} onChange={handleChange}>
                                  <option value={0} disabled="disabled">seleccione el evento</option>
                                  {evento.map((reg) => {
                                      return (
                                          <option key={reg.id} value={reg.id}>
                                              {reg.nombre}
                                          </option>
                                      );
                                  })}
                              </select>
                          </div>


                          <div className="col-md-6">
                              <label htmlFor="inputCity" className="form-label">Patrocinadores</label>
                              <select className="form-select" aria-label="Default select example" id='patrocinadors_id' name='patrocinadors_id' defaultValue={0} onChange={handleChange}>
                                  <option value={0} disabled="disabled">seleccione el patrocinador  </option>
                                  {patrocinador.map((reg) => {
                                      return (
                                          <option key={reg.id} value={reg.id}>
                                              {reg.nombre}
                                          </option>
                                      );
                                  })}
                              </select>
                          </div>
                          <div className="col-md-6">
                            <label htmlFor="inputAddress" className="form-label">Nombre del desafio</label>
                                <input type="text" className="form-control" id="nombre" name='nombre'  
                                        placeholder="Nombre del desafio" onChange={handleChange}  required/>
                          </div>
                          <div className="col-md-6">
                            <label htmlFor="inputAddress" className="form-label">Descripción del desafio</label>
                                <input type="textarea" className="form-control" id="descripcion" name='descripcion'  
                                        placeholder="Descripción del desafio" onChange={handleChange}  required/>
                          </div>
                          <div className="col-md-6">
                            <label htmlFor="number" className="form-label">Puntaje del desafio</label>
                                <input type="number" className="form-control" id="puntaje" name='puntaje'  
                                        placeholder="Puntaje del desafio" onChange={handleChange}  required/>
                          </div>





                  </Modal.Body>
                  <Modal.Footer>
                      <Button variant="secondary" onClick={handleClose}>
                          Close
                      </Button>
                      <Button variant="primary" autoFocus type="submit" >
                          Guardar
                      </Button>
                  </Modal.Footer>
          </form>

          </Modal>
      </div>
  );
}
export default ModalAgregarDesafio