import React, {useEffect, useState} from "react";
import 'bootstrap/dist/css/bootstrap.min.css';
import {Modal, Button} from 'react-bootstrap';
import { FaClipboardList,FaEye} from "react-icons/fa";
import {fetchData,fetchDataDepend,fetchList} from "../../Libs/Fetch";
import Swal from 'sweetalert2'


function Calificar(prop)
{

    // hook
    const [show, setShow] = useState(false);
    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);
    const [values, setValues] = useState({}); //Guarda los nuevos datos
    const [regiones, setRegiones] = useState([]);
    const [instituciones, setInstituciones] = useState([]);
    const [departamentos, setDepartamentos] = useState([]);
    const [municipios, setMunicipios] = useState([]);
    const [row, setRow] = useState(prop.row);


    //pesticiones
    const handleChange = (event) => {

        const {target: { name, value },} = event;
        setValues((values) => ({ ...values, [name]: value }));
    };

// cargar los optiom
    useEffect(() => fetchList("institucion", setInstituciones), [prop.setEstado]);
    useEffect(() => fetchList("region", setRegiones), [prop.setEstado]);
    useEffect(() => fetchDataDepend("region", "departamentos", values.region, setDepartamentos), [values.region]);
    useEffect(() => fetchDataDepend("departamento", "municipios", values.departamento, setMunicipios), [values.departamento]);


 // carga datos selecionado
    useEffect(() => fetchDataDepend("region", "departamentos", row.region.id, setDepartamentos), [row.region.id]);
    useEffect(() => fetchDataDepend("departamento", "municipios", row.departamento.id, setMunicipios), [row.departamento.id]);
    const Actualizar = async (event) =>
    {


        event.preventDefault();
        const inst = values;



        if(Object.keys(inst).length === 0)
        {

            Swal.fire(
                'Aviso',
                'Lo datos son los mismo, Modifique datos para actualizar',
                'info'
            )
        }
        else {

            const { response } = await fetchData(`sede/editar/${prop.row.id}`, prop.setEstado, {
                method: "PUT",
                data: inst,
            });



            // setEstado(!estado);
            handleClose();
        }

    }

    return(
        <div>
            <Button  className='btn btn-success' onClick={handleShow}>
                <FaClipboardList/>
            </Button>

            <Modal show={show} onHide={handleClose} centered>
                <Modal.Header closeButton>
                    <Modal.Title>Asignación de puntajes</Modal.Title>
                </Modal.Header>
                <form onSubmit={(event) => Actualizar(event)}>
                    <Modal.Body className="row g-3">


                        <div className="col-6">
                            <label htmlFor="inputAddress" className="form-label">1ra puntuación</label>
                            <input type="text" className="form-control" id="puntaje" name='Puntaje'  onChange={handleChange}
                                   placeholder="Asigne una calificación" required/>
                        </div>
                        
                        <div className="col-6">
                            <label htmlFor="inputAddress" className="form-label">2da puntuación</label>
                            <input type="text" className="form-control" id="puntaje" name='Puntaje'  onChange={handleChange}
                                   placeholder="Asigne una calificación" required/>
                        </div>

                        <div className="col-12">
                            <label htmlFor="inputAddress" className="form-label">Puntuación final</label>
                            <input type="text" className="form-control" id="puntaje" name='Puntaje'  onChange={handleChange}
                                   placeholder="Asigne una calificación" disabled/>
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

export default Calificar;