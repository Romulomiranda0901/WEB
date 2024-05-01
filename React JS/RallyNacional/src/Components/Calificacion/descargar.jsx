import React, {useEffect, useState} from "react";
import 'bootstrap/dist/css/bootstrap.min.css';
import {Modal, Button} from 'react-bootstrap';
import { FaArrowCircleDown,FaEye} from "react-icons/fa";
import {fetchData,fetchDataDepend,fetchList} from "../../Libs/Fetch";
import Swal from 'sweetalert2'


function Descargar(prop)
{

    // hook
    const [show, setShow] = useState(false);
    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);

    return(
        <div>
            <Button  className='btn btn-primary' onClick={handleShow}>
                <FaArrowCircleDown/>
            </Button>

            {/* <Modal show={show} onHide={handleClose} centered>
                <Modal.Header closeButton>
                    <Modal.Title>Entregables del Equipo</Modal.Title>
                </Modal.Header>
                    <Modal.Body className="row g-3">
                        <div className="col-12">
                            <label htmlFor="inputAddress" className="form-label">Nombre equipos</label>
                        </div>
                        <div className="col-md-6">
                            <label htmlFor="inputEmail4" className="form-label">Sede</label>
                        </div>
                        <div className="col-md-6">
                            <label htmlFor="inputPassword4" className="form-label">Puntiacio/</label>
                        </div>


                        <div className="col-md-6">
                            <label htmlFor="inputCity" className="form-label">Departamento</label>
                        </div>
                        <div className="col-md-6">
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

            </Modal> */}
        </div>
    )
}

export default Descargar;