import React, {useEffect, useState} from "react";
import 'bootstrap/dist/css/bootstrap.min.css';
import {Modal, Button} from 'react-bootstrap';
import { FaPlusSquare,FaEye} from "react-icons/fa";
import {fetchData,fetchDataDepend,fetchList} from "../../Libs/Fetch";




function ModalAgregar({setEstado}) {

    const [show, setShow] = useState(false);
    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);
    const [values, setValues] = useState({}); //Guarda los nuevos datos
    const [regiones, setRegiones] = useState([]);
    const [instituciones, setInstituciones] = useState([]);
    const [departamentos, setDepartamentos] = useState([]);
    const [municipios, setMunicipios] = useState([])



    const handleChange = (event) => {

        const {target: { name, value },} = event;
        setValues((values) => ({ ...values, [name]: value }));
    };
    useEffect(() => fetchList("institucion", setInstituciones), [setEstado]);
    useEffect(() => fetchList("region", setRegiones), [setEstado]);
    useEffect(() => fetchDataDepend("region", "departamentos", values.region, setDepartamentos), [values.region]);
    useEffect(() => fetchDataDepend("departamento", "municipios", values.departamento, setMunicipios), [values.departamento]);





    const agregar = async (event) =>
    {
        event.preventDefault();
        const inst = values;
        const { response } = await fetchData("sede/crear", setEstado,{
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
                    <Modal.Title>Sedes</Modal.Title>
                </Modal.Header>
                <form onSubmit={(event) => agregar(event)}>
                    <Modal.Body className="row g-3">


                            <div className="col-12">
                                <label htmlFor="inputAddress" className="form-label">Nombre Sedes</label>
                                <input type="text" className="form-control" id="nombre" name='nombre'  onChange={handleChange}
                                       placeholder="Nombre de sedes"   required/>
                            </div>
                            <div className="col-md-6">
                                <label htmlFor="inputEmail4" className="form-label">Institucion</label>
                                <select className="form-select" aria-label="Default select example" name='institucion_id' id='institucion_id' defaultValue={0}  onChange={handleChange}>
                                    <option value={0} disabled="disabled">seleccione la institucion</option>
                                    {instituciones.map((inst) => {
                                        return (
                                            <option key={inst.id} value={inst.id}>
                                                {inst.nombre}
                                            </option>
                                        );
                                    })}
                                </select>
                            </div>
                            <div className="col-md-6">
                                <label htmlFor="inputPassword4" className="form-label">Region</label>
                                <select className="form-select" aria-label="Default select example" name='region' id='region' defaultValue={0}  onChange={handleChange}>
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
                                <select className="form-select" aria-label="Default select example" id='departamento' name='departamento' defaultValue={0} onChange={handleChange}>
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
                                <select id="municipio_id" className="form-select"   onChange={handleChange} name='municipio_id' defaultValue={0}>
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
        </>
    );
} export default ModalAgregar