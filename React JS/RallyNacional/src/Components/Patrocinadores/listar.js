import React, {useEffect, useState} from 'react';
import {fetchData, fetchDataDepend, fetchDelete, fetchList} from "../../Libs/Fetch";
import {FaEye, FaPlusSquare, FaTrash} from 'react-icons/fa';
import BootstrapTable from 'react-bootstrap-table-next';
import paginationFactory from 'react-bootstrap-table2-paginator';
import ToolkitProvider, { Search }  from 'react-bootstrap-table2-toolkit/dist/react-bootstrap-table2-toolkit';
import ModalAgregar from "../Patrocinadores/crear";
import Actualizar from "../Patrocinadores/Actualizar";
const listar =() =>{

    // eslint-disable-next-line react-hooks/rules-of-hooks
    const [rows, setRows] = useState([]); //Guarda la lista de instituciones
    // eslint-disable-next-line react-hooks/rules-of-hooks
    const [estado, setEstado] = useState(false);
    // eslint-disable-next-line react-hooks/rules-of-hooks
    const [currentPage, SetcurrentPage] =  useState(1);
    // eslint-disable-next-line react-hooks/rules-of-hooks
    const [todosPerPage, SettodosPerPage] =  useState(1);
    const { SearchBar, ClearSearchButton } = Search;


    // eslint-disable-next-line react-hooks/rules-of-hooks
    useEffect(() => fetchList("patrocinador", setRows), [estado]);


    const deletepatrocinador = (id) => {

        fetchDelete('patrocinador', setEstado, {}, {id})

    }

    function iconAcion(cell, row, rowIndex, formatExtraData)
    {


        return (

            <div className='row justify-content-center row-cols-2 row-cols-lg-5 g-2 g-lg-3'>
                <div className="col ">
                    <Actualizar row ={row} setEstado={setEstado} />
                </div>
                <br></br>
                <div className="col "> <button onClick= {()=>deletepatrocinador(row.id)}  className='btn btn-danger'><FaTrash /></button></div>
            </div>
        );
    }

    function iconPatrociandor(cell, row, rowIndex, formatExtraData)
    {
        console.log(row);

        return (

            <div className='row justify-content-center row-cols-2 row-cols-lg-5 g-2 g-lg-3'>
                <div className="col "><img src={`${process.env.REACT_APP_API_URL}/${row.logo}`} /></div>
            </div>
        );
    }

    const columns = [
        {
            dataField: 'id',
            text: ' #'
        }, {
            dataField: 'nombre',
            text: 'nombre'
        },

        {
            dataField: 'logo',
            text: 'Logo',
            formatter: iconPatrociandor
        },

        {
            dataField: 'Aciones',
            text: 'Aciones',
            formatter: iconAcion

        }


        ];

    return(
        <div className='container'>
            <div className='container'>

                <ToolkitProvider keyField="id" data={ rows } columns={ columns } search >
                    {
                        props => (
                            <div className='container'>
                                <h6>Ingrese de la sede :</h6>
                                <div className="row ">
                                    <div className="col">
                                        <SearchBar
                                            placeholder = 'Buscar'
                                            srText =''
                                            { ...props.searchProps }
                                        />
                                    </div>
                                    <div className="col ">
                                        <ClearSearchButton { ...props.searchProps  } className='btn btn-secondary  ' />
                                    </div>
                                    <div className="col">
                                        <a href="./crearPatrocinador" className="btn btn-primary"
                                           role="button" aria-disabled="true"> <FaPlusSquare/></a>
                                    </div>

                                </div>


                                <hr />
                                <BootstrapTable
                                    { ...props.baseProps }
                                    headerWrapperClasses="table-light "
                                    keyField='id'
                                    data={ rows }
                                    columns={ columns }
                                    hover
                                    noDataIndication=" No hay Datos "
                                    insertRow={true}
                                    deleteRow={true}
                                    pagination={ paginationFactory() }

                                />

                            </div>
                        )
                    }
                </ToolkitProvider>



            </div>
        </div>
    )

}
export default listar;