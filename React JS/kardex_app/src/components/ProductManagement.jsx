import React, { useState } from 'react';
import { Table, Button, Modal, Form } from 'react-bootstrap';

const ProductManagement = ({ products, setProducts, units }) => {
    const [showModal, setShowModal] = useState(false);
    const [newProduct, setNewProduct] = useState({ name: '', unit: '', price: '' });
    const [editIndex, setEditIndex] = useState(null);

    const handleCloseModal = () => {
        setShowModal(false);
        setNewProduct({ name: '', unit: '', price: '' });
        setEditIndex(null);
    };

    const handleShowModal = () => setShowModal(true);

    const handleChange = (e) => {
        const { name, value } = e.target;
        setNewProduct({ ...newProduct, [name]: value });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        if (editIndex !== null) {
            const updatedProducts = products.map((product, index) =>
                index === editIndex ? newProduct : product
            );
            setProducts(updatedProducts);
            handleCloseModal();
        } else {
            setProducts([...products, newProduct]);
            handleCloseModal();
        }
    };

    const handleEdit = (index) => {
        setNewProduct(products[index]);
        setEditIndex(index);
        handleShowModal();
    };

    const handleDelete = (index) => {
        const updatedProducts = products.filter((_, i) => i !== index);
        setProducts(updatedProducts);
    };

    return (
        <div>
            <h2>Gestión de Productos</h2>
            <Button variant="primary" onClick={handleShowModal} className="mb-3">
                Agregar Producto
            </Button>
            <Table striped bordered hover>
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Unidad de Medida</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                {products.map((product, index) => (
                    <tr key={index}>
                        <td>{product.name}</td>
                        <td>{product.unit}</td>
                        <td>${product.price}</td>
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

            {/* Modal for Add/Edit Product */}
            <Modal show={showModal} onHide={handleCloseModal}>
                <Modal.Header closeButton>
                    <Modal.Title>{editIndex !== null ? 'Editar Producto' : 'Agregar Producto'}</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <Form onSubmit={handleSubmit}>
                        <Form.Group controlId="formProductName">
                            <Form.Label>Nombre del Producto</Form.Label>
                            <Form.Control
                                type="text"
                                name="name"
                                value={newProduct.name}
                                onChange={handleChange}
                                placeholder="Nombre del Producto"
                                required
                            />
                        </Form.Group>
                        <Form.Group controlId="formProductUnit">
                            <Form.Label>Unidad de Medida</Form.Label>
                            <Form.Control
                                as="select"
                                name="unit"
                                value={newProduct.unit}
                                onChange={handleChange}
                                required
                            >
                                <option value="">Seleccionar Unidad de Medida</option>
                                {units.map((unit, index) => (
                                    <option key={index} value={unit.name}>
                                        {unit.name} ({unit.abbreviation})
                                    </option>
                                ))}
                            </Form.Control>
                        </Form.Group>
                        <Form.Group controlId="formProductPrice">
                            <Form.Label>Precio</Form.Label>
                            <Form.Control
                                type="number"
                                name="price"
                                value={newProduct.price}
                                onChange={handleChange}
                                placeholder="Precio"
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

export default ProductManagement;
