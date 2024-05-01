import React, {useEffect, useState} from 'react'
import axios from 'axios';
import {fetchData, fetchDataDepend, fetchDelete, fetchList} from "../../Libs/Fetch";
import { FaEye, FaTrash } from 'react-icons/fa';
import BootstrapTable from 'react-bootstrap-table-next';
import paginationFactory from 'react-bootstrap-table2-paginator';
import ToolkitProvider, { Search }  from 'react-bootstrap-table2-toolkit/dist/react-bootstrap-table2-toolkit';

function ListarEquipo(props)
{


console.log(props.row)


    const columns = [
        {
            dataField: 'nombres',
            text: 'nombres'
        },

        {
            dataField: 'apellidos',
            text: 'Apellidos'
        },

        {
            dataField: 'cedula',
            text: 'Cedula'
        },

        {
            dataField: 'genero.nombre',
            text: 'Sexo'
        },
        {
            dataField: 'etnico.nombre',
            text: 'Etnia'
        }


    ];

    return(
        <div>
            <BootstrapTable
                headerWrapperClasses="table-light "
                keyField='id'
                data={props.row}
                columns={columns}
                hover
                noDataIndication=" No hay Datos "



            />
        </div>
    )

} export default ListarEquipo;