import React, {useEffect, useState} from "react";
import 'bootstrap/dist/css/bootstrap.min.css';
import {Modal, Button} from 'react-bootstrap';
import { FaPencilAlt,FaEye} from "react-icons/fa";
import {fetchData,fetchDataDepend,fetchList} from "../../Libs/Fetch";
import ToolkitProvider, { Search }  from 'react-bootstrap-table2-toolkit/dist/react-bootstrap-table2-toolkit';
import Swal from 'sweetalert2'
import BootstrapTable from 'react-bootstrap-table-next';
import paginationFactory from 'react-bootstrap-table2-paginator';


function SeleccionarGanador(prop)
{

    // hook
    const [show, setShow] = useState(false);
    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);

    const rows = [
        {
            id: 1,
            nombreEquipo: "Los mariposa",
            puntaje: 50,
            proyecto: "Aguas limpias",
            categoria: "Limpieza",
            desafio: "Desafio Cualquiera"

        }
    ]

    const columns = [
        {
            dataField: 'id',
            text: ' #'
        }, {
            dataField: 'nombreEquipo',
            text: 'Equipo'
        },

        {
            dataField: 'puntaje',
            text: 'Puntaje'
        },

        {
            dataField: 'proyecto',
            text: 'Proyecto'
        },
        {
            dataField: 'categoria',
            text: 'Categoria'
        },
        {
            dataField: 'desafio',
            text: 'Desafio'
        },
    ]

    return(
        <div>
            <Button  className='btn btn-warning' onClick={handleShow}>
                <FaPencilAlt/>
            </Button>

            <Modal show={show} size="lg" onHide={handleClose} centered aria-labelledby="contained-modal-title-vcenter">
                <Modal.Header closeButton>
                    <Modal.Title>Selección del equipo ganador</Modal.Title>
                </Modal.Header>
                <form >
                    <Modal.Body className="row g-3">


                        <div className="col-8">
                            <label htmlFor="inputAddress" className="form-label">Añadir comentario</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="comentario" 
                            placeholder="Añada un comentario" required></textarea>
                        </div>

                        <ToolkitProvider keyField="id" data={ rows } columns={ columns } search >
                {
                    props => (
                        <div className='container'>
                            <h6>Equipo seleccionado :</h6>


                            <hr />
                            <BootstrapTable
                                { ...props.baseProps }
                                headerWrapperClasses="table-light "
                                keyField='id'
                                data={ rows }
                                columns={ columns }
                                hover
                                noDataIndication=" No hay Datos "
                                insertRow={true}
                                deleteRow={true}
                                pagination={ paginationFactory() }

                            />

                        </div>
                    )
                }
            </ToolkitProvider>
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

export default SeleccionarGanador;