import React, {useState} from "react";
import 'bootstrap/dist/css/bootstrap.min.css';
import {Modal, Button} from 'react-bootstrap';
import { FaEye,} from "react-icons/fa";
import {fetchData} from "../../Libs/Fetch";

function ModalActualizar(prop)
{
   // const {datos} = prop.row;

    const [show, setShow] = useState(false);
    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);
    const [values, setValues] = useState({}); //Guarda los nuevos datos

    const handleChange = (event) => {

        const {target: { name, value },} = event;
        setValues((values) => ({ ...values, [name]: value }));
    };
    const Actualizar = async (event) =>
    {

        event.preventDefault();
        const inst = values;

        const { response } = await fetchData(`patrocinador/editar/${prop.row.id}`, prop.setEstado, {
            method: "PUT",
            data: inst,
        });

        setValues({});
        // setEstado(!estado);
        handleClose();

    }

    return (
        <>
            <Button  className='btn btn-primary' onClick={handleShow}>
                <FaEye/>
            </Button>

            <Modal show={show} onHide={handleClose} centered>
                <Modal.Header closeButton>
                    <Modal.Title>Editar Patrocinador</Modal.Title>
                </Modal.Header>
                <form onSubmit={(event) => Actualizar(event)}>
                    <Modal.Body>

                        <div className="form-group">
                            <label htmlFor="nombre">Nombre del Patrocinador: </label>
                            <input type="text" className="form-control" id="nombre" name="nombre"  onChange={handleChange}  defaultValue={prop.row.nombre} required/>

                        </div>
                        <div className="form-group">
                            <label htmlFor="nombre">Logo: </label>
                            <input type="text" className="form-control" id="logo" name="logo"  onChange={handleChange} defaultValue={prop.row.abreviacion} required />

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
        </>
    )
}export default ModalActualizar;
