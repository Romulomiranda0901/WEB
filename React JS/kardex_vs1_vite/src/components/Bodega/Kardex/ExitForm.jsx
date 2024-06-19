import React, { useState } from 'react';
import { Form, Button, Row, Col, Table } from 'react-bootstrap';

const ExitForm = ({ addEntry, products, dependencies }) => {
    const [currentEntry, setCurrentEntry] = useState({ product: '', quantity: '' });
    const [entryList, setEntryList] = useState([]);
    const [selectedDependency, setSelectedDependency] = useState('');

    const handleChange = (e) => {
        const { name, value } = e.target;
        setCurrentEntry({ ...currentEntry, [name]: value });
    };

    const handleDependencyChange = (e) => {
        setSelectedDependency(e.target.value);
    };

    const handleAddProduct = () => {
        if (currentEntry.product && currentEntry.quantity && selectedDependency) {
            setEntryList([...entryList, { ...currentEntry, type: 'Salida', dependency: selectedDependency,date: new Date().toISOString().slice(0, 10) }]);
            setCurrentEntry({ product: '', quantity: '' });
        } else {
            alert('Por favor complete todos los campos');
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        if (entryList.length === 0) {
            alert('Agregue al menos un producto para realizar la salida.');
            return;
        }

        console.log(entryList);
        addEntry(entryList);
        setEntryList([]);
        setSelectedDependency('');
        setCurrentEntry({ product: '', quantity: '' }); // Limpiar el formulario después de enviar
    };

    return (
        <div className="mt-4">
            <h4 className="mb-4">Formulario de Salida de Productos</h4>
            <Form onSubmit={handleSubmit} noValidate> {/* Agregamos noValidate aquí */}
                <Row className="mb-3">
                    <Form.Group as={Col} controlId="formProduct">
                        <Form.Label>Producto</Form.Label>
                        <Form.Control
                            as="select"
                            name="product"
                            value={currentEntry.product}
                            onChange={handleChange}
                            required
                        >
                            <option value="">Seleccionar Producto</option>
                            {products.map((product, index) => (
                                <option key={index} value={product.name}>
                                    {product.name}
                                </option>
                            ))}
                        </Form.Control>
                    </Form.Group>
                    <Form.Group as={Col} controlId="formQuantity">
                        <Form.Label>Cantidad</Form.Label>
                        <Form.Control
                            type="number"
                            name="quantity"
                            value={currentEntry.quantity}
                            onChange={handleChange}
                            placeholder="Cantidad"
                            required
                        />
                    </Form.Group>
                    <Form.Group as={Col} controlId="formDependency">
                        <Form.Label>Dependencia</Form.Label>
                        <Form.Control
                            as="select"
                            name="dependency"
                            value={selectedDependency}
                            onChange={handleDependencyChange}
                            required
                        >
                            <option value="">Seleccionar Dependencia</option>
                            {dependencies.map((dependency, index) => (
                                <option key={index} value={dependency.name}>
                                    {dependency.name}
                                </option>
                            ))}
                        </Form.Control>
                    </Form.Group>
                </Row>
                <Row className="mb-3">
                    <Col xs={12} md={6}>
                        <Button variant="secondary" onClick={handleAddProduct} block>
                            Agregar Producto
                        </Button>
                    </Col>
                    <Col xs={12} md={6}>
                        {entryList.length > 0 && (
                            <Button variant="primary" type="submit" block>
                                Realizar Salida
                            </Button>
                        )}
                    </Col>
                </Row>
            </Form>
            {entryList.length > 0 && (
                <div className="mt-4">
                    <h5>Productos a Salir:</h5>
                    <Table striped bordered hover>
                        <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Dependencia</th>
                        </tr>
                        </thead>
                        <tbody>
                        {entryList.map((entry, index) => (
                            <tr key={index}>
                                <td>{entry.product}</td>
                                <td>{entry.quantity}</td>
                                <td>{entry.dependency}</td>
                            </tr>
                        ))}
                        </tbody>
                    </Table>
                </div>
            )}
        </div>
    );
};

export default ExitForm;
