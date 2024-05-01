import React, {useState} from "react";
import 'bootstrap/dist/css/bootstrap.min.css';
import {Modal, Button} from 'react-bootstrap';
import { FaPlusSquare,} from "react-icons/fa";
import {fetchData} from "../../Libs/Fetch";



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
        const patr = values;
        const { response } = await fetchData("patrocinador/crear", setEstado,{
            method: "POST",
            data: patr,
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
                    <Modal.Title>Patrocinadores</Modal.Title>
                </Modal.Header>
                <form onSubmit={(event) => agregar(event)}>
                    <Modal.Body>

                        <div className="form-group">
                            <label htmlFor="nombre">Nombre del patrocinador: </label>
                             <input type="text" className="form-control" id="nombre_patrocinador" name="nombre_patrocinador"  onChange={handleChange} required />

                         </div>
                        <div className="form-group">
                            <label htmlFor="nombre">Logo: </label>
                            <input type="file" className="form-control" id="imagen" name="imagen" onChange={handleChange} required />
                            
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

