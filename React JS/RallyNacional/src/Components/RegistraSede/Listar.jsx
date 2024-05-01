import React, {useEffect, useState} from 'react';
import {fetchData, fetchDataDepend, fetchDelete, fetchList, fetchList2} from "../../Libs/Fetch";
import BootstrapTable from 'react-bootstrap-table-next';
import paginationFactory from 'react-bootstrap-table2-paginator';
import ToolkitProvider, { Search }  from 'react-bootstrap-table2-toolkit/dist/react-bootstrap-table2-toolkit';
import {FaPlusSquare, FaTrash} from "react-icons/fa";
import ActualizarCupos from "./ActualizarCupos";


const ListarSedes = () =>
{
    // eslint-disable-next-line react-hooks/rules-of-hooks
    const [estado, setEstado] = useState(false);
    // eslint-disable-next-line react-hooks/rules-of-hooks
    const [todosPerPage, SettodosPerPage] = useState(1);
    // eslint-disable-next-line react-hooks/rules-of-hooks
    const {SearchBar, ClearSearchButton} = Search;
    // eslint-disable-next-line react-hooks/rules-of-hooks
    const [sedes, setsedes] = useState([]);
    // eslint-disable-next-line react-hooks/rules-of-hooks
    const [coordinador, Setcoordinador] = useState([]);

    useEffect(() => fetchList2("sede/sede_lista", setsedes),[estado]);
    useEffect(() => fetchList2("tipocordinador/coordinador", Setcoordinador), [setEstado]);


    function iconAcion(cell, row, rowIndex, formatExtraData)
    {


        return (

            <div className='row justify-content-center row-cols-2 row-cols-lg-5 g-2 g-lg-3'>
                <div className="col ">
                    <ActualizarCupos row ={row} setEstado={setEstado} sede ={sedes} coordinador={formatExtraData} />
                </div>

            </div>
        );
    }

    const columns = [

         {
            dataField: 'nombre',
            text: 'Sede'
        },

        {
            dataField: 'nombres',
            text: 'Nombres'
        },

        {
            dataField: 'apellidos',
            text: 'Apellidos'
        },
        {
            dataField: 'max_participacion',
            text: 'Cupos'
        },
        {
            dataField: 'Aciones',
            text: 'Aciones',
            formatter: iconAcion,
            formatExtraData:{
                coordinador: coordinador
            }

        }



    ];
    return(

            <div className='container'>
                <div className='container'>

                    <ToolkitProvider keyField="id" data={ sedes } columns={ columns } search >
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
                                            <a href="./inscripcionessedes" className="btn btn-primary"
                                               role="button" aria-disabled="true"> <FaPlusSquare/></a>
                                        </div>

                                    </div>


                                    <hr />
                                    <BootstrapTable
                                        { ...props.baseProps }
                                        headerWrapperClasses="table-light "
                                        keyField='id'
                                        data={ sedes }
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
 export default ListarSedes;