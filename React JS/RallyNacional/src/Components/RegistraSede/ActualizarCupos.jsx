import React, {useEffect, useState} from "react";
import 'bootstrap/dist/css/bootstrap.min.css';
import {Modal, Button} from 'react-bootstrap';
import { FaPlusSquare,FaEye} from "react-icons/fa";
import {fetchData,fetchDataDepend,fetchList} from "../../Libs/Fetch";
import Swal from 'sweetalert2'

const ActualizarCupos =(prop) =>
{
    const [show, setShow] = useState(false);
    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);
    const [values, setValues] = useState({}); //Guarda los nuevos datos
    const sedes = prop.sede;
    const coordinador = prop.coordinador.coordinador;


    const handleChange = (event) => {

        const {target: { name, value },} = event;
        setValues((values) => ({ ...values, [name]: value }));
    };

    const Actualizar = async (event) =>
    {
        event.preventDefault();
        const datos = values;

        if(Object.keys(datos).length === 0)
        {

            Swal.fire(
                'Aviso',
                'Lo datos son los mismo, Modifique datos para actualizar',
                'info'
            )
        }

        else {

            const { response } = await fetchData(`sede/evento/editar/${prop.row.id}`, prop.setEstado, {
                method: "PUT",
                data: datos,
            });
            setValues({});



            // setEstado(!estado);
            handleClose();
        }
    }

    return(
        <div>
            <Button  className='btn btn-primary' onClick={handleShow}>
                <FaEye/>
            </Button>

            <Modal show={show} onHide={handleClose} centered>
                <Modal.Header closeButton>
                    <Modal.Title>Actualizar Cupos</Modal.Title>
                </Modal.Header>
                <form onSubmit={(event) => Actualizar(event)}>
                    <Modal.Body className="row g-3">

                        <div className="col-md-6">
                            <label htmlFor="inputEmail4" className="form-label">Sedes:</label>
                            <select className="form-select" aria-label="Default select example" name='sede_id' id='sede_id' defaultValue={prop.row.sedes_id}  onChange={handleChange} disabled>
                                <option value={0} disabled="disabled">seleccione la Sede </option>
                                {sedes.map((sedes) => {
                                    return (
                                        <option key={sedes.id} value={sedes.id}>
                                            {sedes.nombre}
                                        </option>
                                    );
                                })}
                            </select>
                        </div>
                        <div className="col-md-6">
                            <label htmlFor="inputPassword4" className="form-label">Coordinador:</label>
                            <select className="form-select" aria-label="Default select example" name='coordinador_id' id='coordinador_id' defaultValue={prop.row.coordinador_id}  onChange={handleChange} disabled>
                                <option value={0} disabled="disabled">seleccione la region</option>
                                { coordinador.map((coordinador) => {
                                    return (
                                        <option key={coordinador.id} value={coordinador.id}>
                                            {coordinador.nombres}  {coordinador.apellidos}
                                        </option>
                                    );
                                })}
                            </select>
                        </div>
                        <div className="col-12">
                            <label htmlFor="inputAddress" className="form-label">Cupos</label>
                            <input type="text" className="form-control" id="max_participacion" name='max_participacion'  onChange={handleChange}
                                   placeholder="Nombre de sedes"  defaultValue={prop.row.max_participacion}   required pattern={'[0-9]+'}/>
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
    )
}
export default ActualizarCupos