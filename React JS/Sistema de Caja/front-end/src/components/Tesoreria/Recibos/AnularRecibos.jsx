// AnularRecibos.js
import React from 'react';
import { Modal, Button } from 'react-bootstrap';

const AnularRecibos = ({ showModal, handleModalClose }) => {
    return (
        <Modal show={showModal} onHide={handleModalClose}>
            <Modal.Header closeButton>
                <Modal.Title>Título del Modal</Modal.Title>
            </Modal.Header>
            <Modal.Body>
                <div className="card">
                    <div className="card-body">
                        <form className="formAnular">
                            <div>
                                <label className=" col-form-label mt-2">Observaciones: </label>
                                <textarea type="text" className="form-control" placeholder="observaciones"
                                          aria-label="Observaciones"/>


                            </div>
                        </form>
                    </div>
                </div>
            </Modal.Body>
            <Modal.Footer>
                <Button variant="danger" onClick={handleModalClose}>
                    Cerrar
                </Button>
                <Button variant="primary" onClick={handleModalClose}>
                    Anular
                </Button>
            </Modal.Footer>
        </Modal>
    );
};

export default AnularRecibos;
