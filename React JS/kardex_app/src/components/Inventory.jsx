import React from 'react';
import { Table } from 'react-bootstrap';

const Inventory = ({ inventory }) => {
    // Calcular el valor total del inventario
    const totalValue = Object.values(inventory).reduce((acc, item) => acc + item.quantity * item.value, 0);

    return (
        <div>
            <h2>Inventario</h2>
            <Table striped bordered hover>
                <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Valor Monetario</th>
                </tr>
                </thead>
                <tbody>
                {Object.keys(inventory).map((productName, index) => (
                    <tr key={index}>
                        <td>{productName}</td>
                        <td>{inventory[productName].quantity}</td>
                        <td>${(inventory[productName].quantity * inventory[productName].value).toFixed(2)}</td>
                    </tr>
                ))}
                </tbody>
            </Table>
            <h3>Valor Total en Bodega: ${totalValue.toFixed(2)}</h3>
        </div>
    );
};

export default Inventory;
