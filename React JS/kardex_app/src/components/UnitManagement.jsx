import React, { useState } from 'react';
import { Table, Button, Modal, Form } from 'react-bootstrap';

const UnitManager = ({ units, setUnits }) => {
    const [showModal, setShowModal] = useState(false);
    const [name, setName] = useState('');
    const [abbreviation, setAbbreviation] = useState('');
    const [editIndex, setEditIndex] = useState(null);

    const handleClose = () => {
        setShowModal(false);
        setName('');
        setAbbreviation('');
        setEditIndex(null);
    };

    const handleShow = () => setShowModal(true);

    const handleChange = (e) => {
        const { name, value } = e.target;
        if (name === 'name') {
            setName(value);
        } else if (name === 'abbreviation') {
            setAbbreviation(value);
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        const unit = { name, abbreviation };
        if (editIndex !== null) {
            const updatedUnits = [...units];
            updatedUnits[editIndex] = unit;
            setUnits(updatedUnits);
        } else {
            setUnits([...units, unit]);
        }
        handleClose();
    };

    const handleEdit = (index) => {
        const { name, abbreviation } = units[index];
        setName(name);
        setAbbreviation(abbreviation);
        setEditIndex(index);
        handleShow();
    };

    const handleDelete = (index) => {
        const updatedUnits = units.filter((_, i) => i !== index);
        setUnits(updatedUnits);
    };

    return (
        <div>
            <h2>Unidades de Medida</h2>
            <Button variant="primary" onClick={handleShow} className="mb-3">
                Agregar Unidad
            </Button>
            <Table striped bordered hover>
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Abreviatura</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                {units.map((unit, index) => (
                    <tr key={index}>
                        <td>{unit.name}</td>
                        <td>{unit.abbreviation}</td>
                        <td>
                            <Button variant="warning" onClick={() => handleEdit(index)}>
                                Editar
                            </Button>{' '}
                            <Button variant="danger" onClick={() => handleDelete(index)}>
                                Eliminar
                            </Button>
                        </td>
                    </tr>
                ))}
                </tbody>
            </Table>

            {/* Modal para Agregar/Editar Unidad */}
            <Modal show={showModal} onHide={handleClose}>
                <Modal.Header closeButton>
                    <Modal.Title>{editIndex !== null ? 'Editar Unidad' : 'Agregar Unidad'}</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <Form onSubmit={handleSubmit}>
                        <Form.Group controlId="formUnitName">
                            <Form.Label>Nombre de la Unidad</Form.Label>
                            <Form.Control
                                type="text"
                                name="name"
                                value={name}
                                onChange={handleChange}
                                placeholder="Nombre de la Unidad"
                                required
                            />
                        </Form.Group>
                        <Form.Group controlId="formUnitAbbreviation">
                            <Form.Label>Abreviatura</Form.Label>
                            <Form.Control
                                type="text"
                                name="abbreviation"
                                value={abbreviation}
                                onChange={handleChange}
                                placeholder="Abreviatura"
                                required
                            />
                        </Form.Group>
                        <Button variant="primary" type="submit">
                            {editIndex !== null ? 'Actualizar' : 'Agregar'}
                        </Button>
                    </Form>
                </Modal.Body>
            </Modal>
        </div>
    );
};

export default UnitManager;
