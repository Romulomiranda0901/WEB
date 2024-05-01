import React, {useEffect, useState} from "react";
import 'bootstrap/dist/css/bootstrap.min.css';
import {Modal, Button} from 'react-bootstrap';
import { FaPlusSquare,FaEye} from "react-icons/fa";
import {fetchData,fetchDataDepend,fetchList} from "../../Libs/Fetch";
import Swal from 'sweetalert2'

function ActualizarDesafio(prop)
{
    const [show, setShow] = useState(false);
    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);
    const [values, setValues] = useState({}); //Guarda los nuevos datos


    //peticiones
    const handleChange = (event) => {

        const {target: { name, value },} = event;
        setValues((values) => ({ ...values, [name]: value }));
    };

    const Actualizar = async (event) =>
    {
        event.preventDefault();
        const inst = values;

        const { response } = await fetchData(`desafio/editar/${prop.row.id}`, prop.setEstado, {
            method: "PUT",
            data: inst,
        });

        setValues({});
        // setEstado(!estado);
        handleClose();

    }

    return(
        <div>
            <Button  className='btn btn-primary' onClick={handleShow}>
                <FaEye/>
            </Button>

            <Modal show={show} onHide={handleClose} centered>
                <Modal.Header closeButton>
                    <Modal.Title>Desafios</Modal.Title>
                </Modal.Header>
                <form onSubmit={(event) => Actualizar(event)}>
                    <Modal.Body className="row g-3">


                        <div className="col-12">
                            <label htmlFor="inputAddress" className="form-label">Nombre del desafio</label>
                            <input type="text" className="form-control" id="nombre" name='nombre'  onChange={handleChange}
                                   placeholder="Nombre de sedes"  defaultValue={prop.row.nombre}  required/>
                        </div>

                        <div className="col-12">
                            <label htmlFor="inputAddress" className="form-label">Descripción del desafio</label>
                            <input type="text" className="form-control" id="descripcion" name='descripcion'  onChange={handleChange}
                                   placeholder="Nombre de sedes"  defaultValue={prop.row.descripcion}  required/>
                        </div>

                        {/* <div className="col-12">
                            <label htmlFor="inputAddress" className="form-label">Puntaje del desafio</label>
                            <input type="text" className="form-control" id="puntaje" name='puntaje'  onChange={handleChange}
                                   placeholder="Nombre de sedes"  defaultValue={prop.row.puntaje}  required/>
                        </div> */}





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
    )
}
export default ActualizarDesafio;