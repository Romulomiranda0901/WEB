import React, { useState } from 'react';
import { Table, Button, Modal, Form } from 'react-bootstrap';

const DependenciasManagement = ({ dependencies, setDependencies }) => {
    const [showModal, setShowModal] = useState(false);
    const [currentDependency, setCurrentDependency] = useState({ id: '', name: '' });
    const [isEdit, setIsEdit] = useState(false);

    const handleShowModal = () => setShowModal(true);
    const handleCloseModal = () => {
        setShowModal(false);
        setCurrentDependency({ id: '', name: '' });
        setIsEdit(false);
    };

    const handleChange = (e) => {
        const { name, value } = e.target;
        setCurrentDependency({ ...currentDependency, [name]: value });
    };

    const handleAddDependency = () => {
        setDependencies([...dependencies, { ...currentDependency, id: Date.now().toString() }]);
        handleCloseModal();
    };

    const handleEditDependency = (id) => {
        const dependencyToEdit = dependencies.find(dep => dep.id === id);
        setCurrentDependency(dependencyToEdit);
        setIsEdit(true);
        handleShowModal();
    };

    const handleUpdateDependency = () => {
        setDependencies(dependencies.map(dep => (dep.id === currentDependency.id ? currentDependency : dep)));
        handleCloseModal();
    };

    const handleDeleteDependency = (id) => {
        setDependencies(dependencies.filter(dep => dep.id !== id));
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        isEdit ? handleUpdateDependency() : handleAddDependency();
    };

    return (
        <div>
            <h2>Gestión de Dependencias</h2>
            <Button onClick={handleShowModal} className="mb-4">Agregar Dependencia</Button>
            <Table striped bordered hover>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                {dependencies.map((dependency) => (
                    <tr key={dependency.id}>
                        <td>{dependency.id}</td>
                        <td>{dependency.name}</td>
                        <td>
                            <Button variant="warning" onClick={() => handleEditDependency(dependency.id)}>Editar</Button>{' '}
                            <Button variant="danger" onClick={() => handleDeleteDependency(dependency.id)}>Eliminar</Button>
                        </td>
                    </tr>
                ))}
                </tbody>
            </Table>

            <Modal show={showModal} onHide={handleCloseModal}>
                <Modal.Header closeButton>
                    <Modal.Title>{isEdit ? 'Editar Dependencia' : 'Agregar Dependencia'}</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <Form onSubmit={handleSubmit}>
                        <Form.Group controlId="formDependencyName">
                            <Form.Label>Nombre de la Dependencia</Form.Label>
                            <Form.Control
                                type="text"
                                name="name"
                                value={currentDependency.name}
                                onChange={handleChange}
                                required
                            />
                        </Form.Group>
                        <Button variant="primary" type="submit">
                            {isEdit ? 'Actualizar' : 'Agregar'}
                        </Button>
                    </Form>
                </Modal.Body>
            </Modal>
        </div>
    );
};

export default DependenciasManagement;
