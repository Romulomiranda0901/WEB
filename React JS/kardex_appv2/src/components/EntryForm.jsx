import React, { useState } from 'react';
import { Form, Button, Table } from 'react-bootstrap';

const EntryForm = ({ addEntry, products, providers }) => {
    const [currentEntry, setCurrentEntry] = useState({ product: '', quantity: '', value: '', provider: '' });
    const [entryList, setEntryList] = useState([]);

    const handleChange = (e) => {
        const { name, value } = e.target;
        setCurrentEntry({ ...currentEntry, [name]: value });
    };

    const handleAddProduct = () => {
        console.log(currentEntry);
        if (currentEntry.product && currentEntry.quantity && currentEntry.value && currentEntry.provider) {
            setEntryList([...entryList, { ...currentEntry, type: 'Entrada', date: new Date().toISOString().slice(0, 10) }]);
            setCurrentEntry({ product: '', quantity: '', value: '', provider: '' });
        } else {
            alert('Por favor complete todos los campos');
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault(); // Evitar que el formulario realice la acción por defecto
        if (entryList.length === 0) {
            alert('Agregue al menos un producto para realizar la entrada.');
            return;
        }



        addEntry(entryList);
        setEntryList([]); // Limpiar la lista de entradas después de enviar
        setCurrentEntry({ product: '', quantity: '', value: '', provider: '' }); // Limpiar el formulario después de enviar
    };

    return (
        <div>
            <Form>
                <Form.Group controlId="formProduct">
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
                <Form.Group controlId="formProvider">
                    <Form.Label>Proveedor</Form.Label>
                    <Form.Control
                        as="select"
                        name="provider"
                        value={currentEntry.provider}
                        onChange={handleChange}
                        required
                    >
                        <option value="">Seleccionar Proveedor</option>
                        {providers.map((provider, index) => (
                            <option key={index} value={provider.name}>
                                {provider.name}
                            </option>
                        ))}
                    </Form.Control>
                </Form.Group>
                <Form.Group controlId="formQuantity">
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
                <Form.Group controlId="formValue">
                    <Form.Label>Valor</Form.Label>
                    <Form.Control
                        type="number"
                        name="value"
                        value={currentEntry.value}
                        onChange={handleChange}
                        placeholder="Valor"
                        required
                    />
                </Form.Group>
                <Button variant="secondary" onClick={handleAddProduct}>
                    Agregar Producto
                </Button>
            </Form>
            {entryList.length > 0 && (
                <Table striped bordered hover className="mt-3">
                    <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Proveedor</th>
                        <th>Cantidad</th>
                        <th>Valor</th>
                    </tr>
                    </thead>
                    <tbody>
                    {entryList.map((entry, index) => (
                        <tr key={index}>
                            <td>{entry.product}</td>
                            <td>{entry.provider}</td>
                            <td>{entry.quantity}</td>
                            <td>{entry.value}</td>
                        </tr>
                    ))}
                    </tbody>
                </Table>
            )}
            <Button variant="primary" onClick={handleSubmit} className="mt-3">
                Realizar Entrada
            </Button>
        </div>
    );
};

export default EntryForm;
