import React from 'react';

const KardexEntry = ({ entry }) => {
    console.log(entry);
    return (

        <tr>
            <td>{entry.date}</td>
            <td>{entry.type}</td>
            <td>{entry.product}</td>
            <td>{entry.quantity}</td>
            <td>{entry.value}</td>
        </tr>
    );
};

export default KardexEntry;
