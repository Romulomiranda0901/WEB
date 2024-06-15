import React from 'react';
import KardexTable from './KardexTable';

const Reports = ({ entries }) => {
    return (
        <div>
            <h2>Reporte de Movimientos</h2>
            <KardexTable entries={entries} />
        </div>
    );
};

export default Reports;
