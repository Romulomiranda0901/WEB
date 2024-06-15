import React from 'react';
import { Table } from 'react-bootstrap';

const Inventory = ({ inventory, totalValue }) => {
    console.log(inventory);
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
                {Object.keys(inventory).map((product, index) => (
                    <tr key={index}>
                        <td>{product}</td>
                        <td>{inventory[product].quantity}</td>
                        <td>{inventory[product].value.toFixed(2)}</td>
                    </tr>
                ))}
                </tbody>
            </Table>
            <h3>Valor Total en Bodega: {totalValue}</h3>
        </div>
    );
};

export default Inventory;
