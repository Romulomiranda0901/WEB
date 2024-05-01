import React, {useEffect, useState} from 'react'
import axios from 'axios';
import {fetchData, fetchDataDepend, fetchDelete, fetchList, fetchList2} from "../../Libs/Fetch";
import {FaEye, FaTrash, FaUsers} from 'react-icons/fa';
import BootstrapTable from 'react-bootstrap-table-next';
import paginationFactory from 'react-bootstrap-table2-paginator';
import ToolkitProvider, {Search} from 'react-bootstrap-table2-toolkit/dist/react-bootstrap-table2-toolkit';
import ModalAgregar from "./modalInscripcion";
import ModalActualizar from "./ModalActualizar";
import ListarEquipo from "./ListarEquipo";

const listar = () => {


    // eslint-disable-next-line react-hooks/rules-of-hooks
    const [rows, setRows] = useState([]); //Guarda la lista de equipos
    // eslint-disable-next-line react-hooks/rules-of-hooks
    const [estado, setEstado] = useState(false);
    // eslint-disable-next-line react-hooks/rules-of-hooks
    const [currentPage, SetcurrentPage] = useState(1);
    // eslint-disable-next-line react-hooks/rules-of-hooks
    const [todosPerPage, SettodosPerPage] = useState(1);
    const {SearchBar, ClearSearchButton} = Search;
    // eslint-disable-next-line react-hooks/rules-of-hooks
    const [sedes, setsedes] = useState([]);
    // eslint-disable-next-line react-hooks/rules-of-hooks
    const [genero, setgenero] = useState([]);
    // eslint-disable-next-line react-hooks/rules-of-hooks
    const [desafio, setdesafio] = useState([]);

    // eslint-disable-next-line react-hooks/rules-of-hooks
    const [etnias , setEtnias ] = useState([]);


    // eslint-disable-next-line react-hooks/rules-of-hooks
    useEffect(() => fetchList("equipo", setRows), [estado]);
    // eslint-disable-next-line react-hooks/rules-of-hooks
    useEffect(() => fetchList2("sede/lista_eventosede", setsedes),[estado]);
    // eslint-disable-next-line react-hooks/rules-of-hooks
    useEffect(() => fetchList("genero", setgenero), [estado]);
    // eslint-disable-next-line react-hooks/rules-of-hooks
    useEffect(() => fetchList("desafio", setdesafio),[estado]);

    // eslint-disable-next-line react-hooks/rules-of-hooks
    useEffect(() => fetchList("etnico", setEtnias),[estado]);




    const deleteEquipos = (id) => {

        fetchDelete('equipo', setEstado, {}, {id})

    }

    function iconAcion(cell, row, rowIndex, formatExtraData ) {


        return (

            <div className='row justify-content-center row-cols-2 row-cols-lg-6 g-2 g-lg-3'>
                <div className="col ">
                    <ModalActualizar row={row} setEstado={setEstado} datos={formatExtraData} />
                </div>
                <br/> <br/>
                <div className="col ">
                    <button onClick={() => deleteEquipos(row.id)} className='btn btn-danger'><FaTrash/></button>
                </div>
            </div>
        );
    }





    const columns = [{
        //     dataField: 'id',
        //     text: ' #'
        // }, {
        dataField: 'nombre',
        text: 'Nombre Equipo'
    }, {
        dataField: 'anyo',
        text: 'Año Inscripción'

    },

         {
            dataField: 'sede.nombre',
            text: 'Sede'
        }, {
            dataField: 'Aciones',
            text: 'Aciones',
            formatter: iconAcion,
            formatExtraData:{
                sedes: sedes,
                genero: genero,
                desafio: desafio
            }

        },];

    const expandRow = {
        renderer: (row,rowIndex) => (
            <div>
            <ListarEquipo row = {row.participantes}/>
            </div>
        ),
        showExpandColumn: true,
        expandByColumnOnly: true,
        onExpand: (row, isExpand, rowIndex, e) => {
            console.log(row);

        },
        onExpandAll: (isExpandAll, rows, e) => {

            console.log(rows);
            rows ={};

        }
    };

    return (
        <div className='container'>

            <ToolkitProvider keyField="id" data={rows} columns={columns} search>
                {
                    props => (
                        <div className='container'>
                            <h6>Ingrese el Equipo :</h6>
                            <div className="row ">
                                <div className="col">
                                    <SearchBar
                                        placeholder='Buscar'
                                        srText=''
                                        {...props.searchProps}
                                    />
                                </div>
                                <div className="col ">
                                    <ClearSearchButton {...props.searchProps} className='btn btn-secondary  '/>
                                </div>
                                <div className="col">

                                    <ModalAgregar setEstado={setEstado} sedes={sedes} genero={genero} desafio ={desafio} etnias={etnias}/>
                                </div>

                            </div>


                            <hr/>
                            <BootstrapTable
                                {...props.baseProps}
                                headerWrapperClasses="table-light "
                                keyField='id'
                                data={rows}
                                columns={columns}
                                expandRow={expandRow}
                                hover
                                noDataIndication=" No hay Datos "
                                insertRow={true}
                                deleteRow={true}
                                pagination={paginationFactory()}


                            />

                        </div>
                    )
                }
            </ToolkitProvider>


        </div>

    )
}

export default listar;