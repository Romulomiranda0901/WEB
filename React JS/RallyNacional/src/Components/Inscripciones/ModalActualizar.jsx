import React, {useState, useEffect} from "react";
import 'bootstrap/dist/css/bootstrap.min.css';
import {Modal, Button} from 'react-bootstrap';
import { FaEye,} from "react-icons/fa";
import {fetchData, fetchDataDepend, fetchList, fetchList2} from "../../Libs/Fetch";
import Tab from 'react-bootstrap/Tab'
import Tabs from 'react-bootstrap/Tabs'
import Row from 'react-bootstrap/Row'
import Col from 'react-bootstrap/Col'
import Swal from 'sweetalert2';


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

    const sedes = prop.datos.sedes;
    const desafio=prop.datos.desafio;

    const Actualizar = async (event) =>
    {

        event.preventDefault();



        if(Object.keys(values).length === 0)
        {
            Swal.fire(
                'Aviso!',
                'No hay cambio en los datos, por favor haga Cambio para Actualizar... ',
                'info'
            )
        }
         else
        {
            const inst = values;

            const { response } = await fetchData(`equipo/editar/${prop.row.id}`, prop.setEstado, {
                method: "PUT",
                data: inst,
            });



            setValues({});
            // setEstado(!estado);
            Swal.fire(
                'Aviso',
                'Datos Actualizado Correctamente',
                'success')

            handleClose();
        }



    }

    // tabs
  const [key, setKey] = useState('home');



    return (
        <>
            <Button  className='btn btn-primary' onClick={handleShow}>
                <FaEye/>
            </Button>

            <Modal size="lg"  show={show} onHide={handleClose} centered>
                <Modal.Header closeButton>
                    <Modal.Title>Gestion de Inscripción</Modal.Title>
                </Modal.Header>
                <form onSubmit={(event) => Actualizar(event)}>
                    <Modal.Body>

                    <Tabs
                        id="controlled-tab-example"
                        activeKey={key}
                        onSelect={(k) => setKey(k)}
                        className="mb-3"
                    >
                        <Tab eventKey="home" title="Inscripción de Equipos">
                        <Row>
                          <Col sm={6}>
                                <input type="text" className="form-control" id="nombre" name='nombre'  onChange={handleChange}
                                       placeholder="Nombre de Equipo" defaultValue={prop.row.nombre}  required pattern={'[A-Za-z ]+'}   title="Solo debe Ingresar letras" />
                                       <br />
                                <input type="text" className="form-control" id="anyo" name='anyo'  onChange={handleChange}
                                       placeholder="Año"  defaultValue={prop.row.anyo} required   pattern={'[0-9]+'} title='Solo debe Ingresar Numero mayor que 0'/>
                            </Col>
                            <Col sm={6}>
                                <select id="inputState" className="form-select"   onChange={handleChange} name='sede_id' id='sede_id' defaultValue={prop.row.sede.id}>
                                    <option value={0} disabled="disabled">seleccione la Sede</option>
                                    {sedes.map((reg) => {
                                        return (
                                            <option key={reg.sede.id} value={reg.sede.id}>
                                                {reg.sede.nombre}
                                            </option>
                                        );
                                    })}
                                </select>
                                <br />
                                <select id="inputState" className="form-select"   onChange={handleChange} name='desafio_id' id='desafio_id' defaultValue={prop.row.desafio.id}>
                                    <option value={0} disabled="disabled">seleccione el Desafio</option>
                                    {desafio.map((reg) => {
                                        return (
                                            <option key={reg.id} value={reg.id}>
                                                {reg.nombre}
                                            </option>
                                        );
                                    })}
                                </select>
                            </Col>
                          </Row>
                        </Tab>

                      </Tabs>
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