import React from 'react';
import KardexEntry from './KardexEntry';
import { Table } from 'react-bootstrap';

const KardexTable = ({ entries }) => {
    return (
        <Table striped bordered hover>
            <thead>
            <tr>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
            </tr>
            </thead>
            <tbody>
            {entries.map((entry, index) => (
                <KardexEntry key={index} entry={entry} />
            ))}
            </tbody>
        </Table>
    );
};

export default KardexTable;
