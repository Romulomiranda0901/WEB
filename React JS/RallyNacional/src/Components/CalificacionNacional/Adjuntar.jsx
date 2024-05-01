import React, {useEffect, useState} from "react";
import 'bootstrap/dist/css/bootstrap.min.css';
import {Modal, Button} from 'react-bootstrap';
import { FaPaperclip,FaEye} from "react-icons/fa";
import {fetchData,fetchDataDepend,fetchList} from "../../Libs/Fetch";
import axios from 'axios';

import Tab from 'react-bootstrap/Tab'
import Tabs from 'react-bootstrap/Tabs'
import Row from 'react-bootstrap/Row'
import Col from 'react-bootstrap/Col'
import Tooltip from '@mui/material/Tooltip';
import Swal from 'sweetalert2';
import AddDeleteTableRows from "../add-delete-table-rows/AddDeleteTableRows";


const ModalAdjuntar =() =>
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
        <>
        <Tooltip title="Agregar Equipo">
            <Button  className='btn btn-info' onClick={handleShow}>
                <FaPaperclip/>
            </Button>
        </Tooltip>

            <Modal size="lg"  show={show} onHide={handleClose} centered>
                <Modal.Header closeButton>
                    <Modal.Title>Adjuntar o descargar acta de notas</Modal.Title>
                </Modal.Header>
                <form onSubmit={(event) => mandar(event)}>
                    <Modal.Body>
                    <Tabs
                        id="controlled-tab-example"
                        className="mb-3"
                    >
                        <Tab eventKey="home" title="Adjuntar acta de notas">
                        <div className="form-group">
                            <label htmlFor="nombre">Subir acta de notas: </label>
                            <input type="file" className="form-control" id="imagen" name="imagen" onChange={handleChange} required />
                            <Button variant="primary" autoFocus type="submit" className="mt-3">
                                Subir acta
                            </Button>
                        </div>
                        </Tab>
                        <Tab eventKey="profile" title="Descargar acta de notas">
                          <Row className="justify-content-md-center">
                            <Col xs lg="4">
                              <div className="form-group">
                                <Button variant="dark" autoFocus type="submit" className="mt-3" size="lg">
                                  Descargar acta de notas
                                </Button>
                              </div>
                            </Col>
                          </Row>
                          <br />
                        </Tab>
                      </Tabs>
                    </Modal.Body>
                    <Modal.Footer>
                        <Button variant="secondary" onClick={handleClose}>
                            Cerrar
                        </Button>
                        
                     </Modal.Footer>
                </form>
            </Modal>
        </>
    );
}
export default ModalAdjuntar