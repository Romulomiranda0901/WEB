
import React from "react";
import { Modal, Button } from 'react-bootstrap';
export default  function AgregaEstudiante ( { showModal, handleModalClose })
{
    return (
        <Modal  size="lg" show={showModal} onHide={handleModalClose}>
            <Modal.Header closeButton>
                <Modal.Title>Agregar Estudiante</Modal.Title>
            </Modal.Header>
            <Modal.Body>
                <div className="card">
                    <div className="card-body">
                        <form className="formEstudiante">
                            <div className="row">
                                <div className="col-md-6">
                                    <div className="row">
                                        <label className="col-3 col-form-label mt-2">Carnet: </label>
                                        <div className="col-sm-9">
                                            <input type="text" className="form-control" placeholder="Carnet"
                                                   aria-label="Carnet" id="carnet"/>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-md-6">
                                    <div className="row">
                                        <label className="col-3 col-form-label mt-2">Nombres: </label>
                                        <div className="col-sm-9">
                                            <input type="text" className="form-control" placeholder="Nombres"
                                                   aria-label="Nombres"/>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div className="row">
                                <div className="col-md-6">
                                    <div className="row">
                                        <label className="col-3 col-form-label mt-2">Apellidos: </label>
                                        <div className="col-sm-9">
                                            <input type="text" className="form-control" placeholder="Apellidos"
                                                   aria-label="Carnet" id="carnet"/>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-md-6">
                                    <div className="row">
                                        <label className="col-3 col-form-label mt-2">Carrera: </label>
                                        <div className="col-sm-9">
                                            <select className="form-control" id="moneda">
                                                <option>Carrera 1</option>
                                                <option>Carrera 2</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div className="row">
                                <div className="col-md-6">
                                    <div className="row">
                                        <label className="col-3 col-form-label mt-2">Turno: </label>
                                        <div className="col-sm-9">
                                            <select className="form-control" id="turno" name='turmp'>
                                                <option>Regular</option>
                                                <option>Sabatino</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </Modal.Body>
            <Modal.Footer>
                <Button variant="warning" onClick={handleModalClose}>
                    Cerrar
                </Button>
                <Button variant="primary" onClick={handleModalClose}>
                    Guardar cambios
                </Button>
            </Modal.Footer>
        </Modal>

    )
}