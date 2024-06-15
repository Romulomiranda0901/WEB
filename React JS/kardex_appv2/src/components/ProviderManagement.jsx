import React, { useState } from 'react';
import { Table, Button, Modal, Form } from 'react-bootstrap';

const ProviderManagement = ({ providers, setProviders }) => {
    const [showModal, setShowModal] = useState(false); // Estado para controlar la visibilidad del modal
    const [formData, setFormData] = useState({ // Estado para almacenar los datos del formulario
        id: null,
        name: '',
        contactPerson: '',
        // Agregar más campos según sea necesario para el proveedor
    });

    const handleCloseModal = () => {
        setShowModal(false); // Ocultar el modal
        setFormData({ id: null, name: '', contactPerson: '' }); // Limpiar el formulario
    };

    const handleShowModal = () => setShowModal(true); // Mostrar el modal

    const handleSaveProvider = () => {
        // Lógica para guardar o actualizar el proveedor
        if (formData.id) {
            // Actualizar proveedor existente
            const updatedProviders = providers.map(provider =>
                provider.id === formData.id ? { ...provider, name: formData.name, contactPerson: formData.contactPerson } : provider
            );
            setProviders(updatedProviders);
        } else {
            // Agregar nuevo proveedor
            const newProvider = {
                id: Date.now(), // Generar un ID único (puedes ajustarlo según tu lógica)
                name: formData.name,
                contactPerson: formData.contactPerson,
                // Agregar más campos según corresponda
            };
            setProviders([...providers, newProvider]);
        }
        handleCloseModal(); // Cerrar el modal después de guardar
    };

    const handleEditProvider = (provider) => {
        // Función para manejar la edición de un proveedor
        setFormData({ id: provider.id, name: provider.name, contactPerson: provider.contactPerson });
        handleShowModal(); // Mostrar el modal para editar
    };

    const handleDeleteProvider = (providerId) => {
        // Función para manejar la eliminación de un proveedor
        const updatedProviders = providers.filter(provider => provider.id !== providerId);
        setProviders(updatedProviders);
    };

    return (
        <div>
            <h2>Gestión de Proveedores</h2>
            <Button variant="primary" onClick={handleShowModal}>Agregar Proveedor</Button>

            <Table striped bordered hover>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Contacto</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                {providers.map(provider => (
                    <tr key={provider.id}>
                        <td>{provider.id}</td>
                        <td>{provider.name}</td>
                        <td>{provider.contactPerson}</td>
                        <td>
                            <Button variant="info" onClick={() => handleEditProvider(provider)}>Editar</Button>
                            <Button variant="danger" onClick={() => handleDeleteProvider(provider.id)}>Eliminar</Button>
                        </td>
                    </tr>
                ))}
                </tbody>
            </Table>

            {/* Modal para agregar/editar proveedor */}
            <Modal show={showModal} onHide={handleCloseModal}>
                <Modal.Header closeButton>
                    <Modal.Title>{formData.id ? 'Editar Proveedor' : 'Agregar Proveedor'}</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <Form>
                        <Form.Group controlId="providerName">
                            <Form.Label>Nombre</Form.Label>
                            <Form.Control
                                type="text"
                                value={formData.name}
                                onChange={(e) => setFormData({ ...formData, name: e.target.value })}
                            />
                        </Form.Group>
                        <Form.Group controlId="providerContact">
                            <Form.Label>Contacto</Form.Label>
                            <Form.Control
                                type="text"
                                value={formData.contactPerson}
                                onChange={(e) => setFormData({ ...formData, contactPerson: e.target.value })}
                            />
                        </Form.Group>
                        {/* Agregar más campos según sea necesario para el proveedor */}
                    </Form>
                </Modal.Body>
                <Modal.Footer>
                    <Button variant="secondary" onClick={handleCloseModal}>Cancelar</Button>
                    <Button variant="primary" onClick={handleSaveProvider}>
                        {formData.id ? 'Guardar Cambios' : 'Agregar'}
                    </Button>
                </Modal.Footer>
            </Modal>
        </div>
    );
};

export default ProviderManagement;
