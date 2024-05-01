import React, {useEffect, useState} from "react";
import 'bootstrap/dist/css/bootstrap.min.css';
import {Modal, Button} from 'react-bootstrap';
import { FaPlusSquare,FaEye} from "react-icons/fa";
import {fetchData,fetchDataDepend,fetchList} from "../../Libs/Fetch";

function InscripcionSede(prop)
{
    //hook
    const [show, setShow] = useState(false);
    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);

    return (
        <div>
            <Button  className='btn btn-primary' onClick={handleShow}>
                <FaEye/>
            </Button>

            <Modal show={show} onHide={handleClose} centered>
                <Modal.Header closeButton>
                    <Modal.Title>Sedes</Modal.Title>
                </Modal.Header>
                <form onSubmit={(event) => ''}>
                    <Modal.Body className="row g-3">


                        <div className="col-12">
                            <label htmlFor="inputAddress" className="form-label"> Sedes</label>
                            <input type="text" className="form-control" id="nombre" name='nombre'  onChange={handleChange}
                                   placeholder="Nombre de sedes"   required/>
                        </div>
                        <div className="col-md-6">
                            <label htmlFor="inputEmail4" className="form-label">Coordinador</label>
                            <select className="form-select" aria-label="Default select example" name='institucion_id' id='institucion_id'   onChange={handleChange}>
                                <option value={0} disabled="disabled">seleccione Selecciones</option>

                            </select>
                        </div>
                        <div className="col-md-6">
                            <label htmlFor="inputPassword4" className="form-label">Region</label>
                            <select className="form-select" aria-label="Default select example" name='region' id='region' defaultValue={prop.row.region.id}  onChange={handleChange}>
                                <option value={0} disabled="disabled">seleccione la region</option>
                                {regiones.map((reg) => {
                                    return (
                                        <option key={reg.id} value={reg.id}>
                                            {reg.nombre}
                                        </option>
                                    );
                                })}
                            </select>
                        </div>


                        <div className="col-md-6">
                            <label htmlFor="inputCity" className="form-label">Departamento</label>
                            <select className="form-select" aria-label="Default select example" id='departamento' name='departamento' defaultValue={prop.row.departamento.id} onChange={handleChange}>
                                <option value={0} disabled="disabled">seleccione el Departamento</option>
                                {departamentos.map((reg) => {
                                    return (
                                        <option key={reg.id} value={reg.id}>
                                            {reg.nombre}
                                        </option>
                                    );
                                })}
                            </select>
                        </div>
                        <div className="col-md-6">
                            <label htmlFor="inputState" className="form-label">Municipio</label>
                            <select id="inputState" className="form-select"   onChange={handleChange} name='municipio_id' id='municipio_id' defaultValue={prop.row.municipio.id}>
                                <option value={0} disabled="disabled">seleccione el Departamento</option>
                                {municipios.map((reg) => {
                                    return (
                                        <option key={reg.id} value={reg.id}>
                                            {reg.nombre}
                                        </option>
                                    );
                                })}
                            </select>
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
 export default InscripcionSede