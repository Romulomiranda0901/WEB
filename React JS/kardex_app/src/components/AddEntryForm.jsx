import React, { useState } from 'react';
import { Form, Button } from 'react-bootstrap';

const AddEntryForm = ({ addEntry, products, providers, dependencies }) => {
    const [entry, setEntry] = useState({ date: '', type: '', product: '', quantity: '', value: '', provider: '', dependency: '' });

    const handleChange = (e) => {
        const { name, value } = e.target;
        setEntry({ ...entry, [name]: value });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        addEntry(entry);
        setEntry({ date: '', type: '', product: '', quantity: '', value: '', provider: '', dependency: '' });
    };

    return (
        <Form onSubmit={handleSubmit} className="mb-4">
            <Form.Group controlId="formDate">
                <Form.Label>Fecha</Form.Label>
                <Form.Control
                    type="date"
                    name="date"
                    value={entry.date}
                    onChange={handleChange}
                    required
                />
            </Form.Group>
            <Form.Group controlId="formType">
                <Form.Label>Tipo</Form.Label>
                <Form.Control
                    as="select"
                    name="type"
                    value={entry.type}
                    onChange={handleChange}
                    required
                >
                    <option value="">Seleccionar Tipo</option>
                    <option value="Entrada">Entrada</option>
                    <option value="Salida">Salida</option>
                </Form.Control>
            </Form.Group>
            <Form.Group controlId="formProduct">
                <Form.Label>Producto</Form.Label>
                <Form.Control
                    as="select"
                    name="product"
                    value={entry.product}
                    onChange={handleChange}
                    required
                >
                    <option value="">Seleccionar Producto</option>
                    {products?.map(product => (
                        <option key={product.id} value={product.name}>{product.name}</option>
                    ))}
                </Form.Control>
            </Form.Group>
            {entry.type === 'Entrada' && (
                <>
                    <Form.Group controlId="formProvider">
                        <Form.Label>Proveedor</Form.Label>
                        <Form.Control
                            as="select"
                            name="provider"
                            value={entry.provider}
                            onChange={handleChange}
                        >
                            <option value="">Seleccionar Proveedor</option>
                            {providers?.map(provider => (
                                <option key={provider.id} value={provider.name}>{provider.name}</option>
                            ))}
                        </Form.Control>
                    </Form.Group>
                    <Form.Group controlId="formValue">
                        <Form.Label>Valor Monetario</Form.Label>
                        <Form.Control
                            type="number"
                            name="value"
                            value={entry.value}
                            onChange={handleChange}
                            placeholder="Valor Monetario"
                            required
                        />
                    </Form.Group>
                </>
            )}
            {entry.type === 'Salida' && (
                <Form.Group controlId="formDependency">
                    <Form.Label>Dependencia Destino</Form.Label>
                    <Form.Control
                        as="select"
                        name="dependency"
                        value={entry.dependency}
                        onChange={handleChange}
                    >
                        <option value="">Seleccionar Dependencia</option>
                        {dependencies?.map(dependency => (
                            <option key={dependency.id} value={dependency.name}>{dependency.name}</option>
                        ))}
                    </Form.Control>
                </Form.Group>
            )}
            <Form.Group controlId="formQuantity">
                <Form.Label>Cantidad</Form.Label>
                <Form.Control
                    type="number"
                    name="quantity"
                    value={entry.quantity}
                    onChange={handleChange}
                    placeholder="Cantidad"
                    required
                />
            </Form.Group>
            <Button variant="primary" type="submit">
                Agregar
            </Button>
        </Form>
    );
};

export default AddEntryForm;
