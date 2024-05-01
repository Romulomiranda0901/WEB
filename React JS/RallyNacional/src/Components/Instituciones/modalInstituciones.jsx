import React, {useState} from "react";
import 'bootstrap/dist/css/bootstrap.min.css';
import {Modal, Button} from 'react-bootstrap';
import { FaPlusSquare,} from "react-icons/fa";
import {fetchData,fetchDataDepend,fetchList} from "../../Libs/Fetch";



function ModalAgregar({setEstado}) {

    const [show, setShow] = useState(false);
    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);
    const [values, setValues] = useState({}); //Guarda los nuevos datos

    const handleChange = (event) => {

        const {target: { name, value },} = event;
        setValues((values) => ({ ...values, [name]: value }));
    };

    const agregar = async (event) =>
    {
        event.preventDefault();
        const inst = values;
        const { response } = await fetchData("institucion/crear", setEstado,{
            method: "POST",
            data: inst,
        });

        setValues({});
       // setEstado(!estado);
        handleClose();

    }

    return (
        <>
            <Button  className='btn btn-primary' onClick={handleShow}>
                <FaPlusSquare/>
            </Button>

            <Modal show={show} onHide={handleClose} centered>
                <Modal.Header closeButton>
                    <Modal.Title>Instituciones</Modal.Title>
                </Modal.Header>
                <form onSubmit={(event) => agregar(event)}>
                    <Modal.Body>

                        <div className="form-group">
                            <label htmlFor="nombre">Nombre Institucion: </label>
                             <input type="text" className="form-control" id="nombre" name="nombre"  onChange={handleChange} required />

                         </div>
                        <div className="form-group">
                            <label htmlFor="nombre">Abreviacion: </label>
                            <input type="text" className="form-control" id="abreviacion" name="abreviacion"  onChange={handleChange} required />

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
    );
} export default ModalAgregar

