import React, {useState, useEffect} from "react";
import 'bootstrap/dist/css/bootstrap.min.css';
import {Modal, Button} from 'react-bootstrap';
import { FaPlusSquare,} from "react-icons/fa";
import {fetchData,fetchDataDepend,fetchList} from "../../Libs/Fetch";
import Tab from 'react-bootstrap/Tab'
import Tabs from 'react-bootstrap/Tabs'
import Row from 'react-bootstrap/Row'
import Col from 'react-bootstrap/Col'
import Tooltip from '@mui/material/Tooltip';
import Swal from 'sweetalert2';
import AddDeleteTableRows from "../add-delete-table-rows/AddDeleteTableRows";
import EquipoFormulario from "./Equipos";



function ModalAgregar(prop) {


    const [show, setShow] = useState(false);
    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);
    const [equipo, setEquipo] = useState({}); //Guarda los nuevos datos
    const [participantes, setParticipantes] = useState([]); //Guarda los nuevos datos
    const [coordinador, setCoordinador] =  useState('');

    const agregar = async (event) =>
    {
        event.preventDefault();
        let respuesta;
        let msg;
        let icon;



        for(let i =0; i<participantes.length;i++)
        {
            if(participantes[i]['cedula'] ===coordinador )
            {
                participantes[i]['coordinador'] =coordinador;
                console.log(participantes[i]);
            }
            else {
                participantes[i]['coordinador'] = ''
            }


        }




        if(participantes.length >0 )
        {
            const { response } = await fetchData("equipo/crear", prop.setEstado,{
                method: "POST",
                data: {
                    ...equipo,
                    participantes
                },
            });

            respuesta = response.data.respuesta;
            if(respuesta === false)
            {
                msg = response.data.msg;
                icon = 'warning';

            }

            else {
                msg = 'Datos registrado Correctamente';
                icon = 'success';
                setEquipo({});
                setParticipantes([]);

            }

            Swal.fire(
                'Aviso',
                msg,
                icon)


            handleClose();
        }
        else
        {
            Swal.fire(
                'Aviso',
                'Debe Ingresar los datos de los Participantes',
                'warning'
            )
        }



       // setValues({});
        //setEstado(!estado);


    }
    // tabs
  const [key, setKey] = useState('home');

    return (
        <>
        <Tooltip title="Agregar Equipo">
            <Button  className='btn btn-primary' onClick={handleShow}>
                <FaPlusSquare/>
            </Button>
        </Tooltip>

            <Modal size="lg"  show={show} onHide={handleClose} centered>
                <Modal.Header closeButton>
                    <Modal.Title>Gestion de Inscripción</Modal.Title>
                </Modal.Header>
                <form onSubmit={(event) => agregar(event)}>
                    <Modal.Body>
                    <Tabs
                        id="controlled-tab-example"
                        activeKey={key}
                        onSelect={(k) => setKey(k)}
                        className="mb-3"
                    >
                        <Tab eventKey="home" title="Inscripción de Equipos">
                            <EquipoFormulario values={equipo} setValue={setEquipo}  sedes = {prop.sedes} desafio={prop.desafio} />
                        </Tab>
                        <Tab eventKey="profile" title="Inscripcion de Participantes">
                          <Row>
                              <Col>
                              <AddDeleteTableRows  values={participantes} setValue={setParticipantes} genero = {prop.genero} coordinador={coordinador} setCoordinador={setCoordinador} etnias={prop.etnias} />
                              </Col>
                          </Row>
                          <br />
                        </Tab>
                      </Tabs>
                    </Modal.Body>
                    <Modal.Footer>
                        <Button variant="secondary" onClick={handleClose}>
                            Cerrar
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

