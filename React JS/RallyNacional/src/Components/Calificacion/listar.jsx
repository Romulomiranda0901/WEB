import React, {useEffect, useState} from 'react'
import {fetchData, fetchDataDepend, fetchDelete, fetchLis, fetchList2} from "../../Libs/Fetch";
import BootstrapTable from 'react-bootstrap-table-next';
import paginationFactory from 'react-bootstrap-table2-paginator';
import ToolkitProvider, { Search }  from 'react-bootstrap-table2-toolkit/dist/react-bootstrap-table2-toolkit';
import Descargar from "./descargar";
import Calificar from "./calificar"
import Youtube from "./youtube"
import ModalAgregar from "./Adjuntar";
import SeleccionarGanador from "./seleccionarGanador"
const listar =() =>
{
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
    const [row1,setRow] =useState({});


    // eslint-disable-next-line react-hooks/rules-of-hooks
    useEffect(() => fetchList2("evaluacion_sede/listar_equipo" , setRows), [estado]);

    const rowActual =(row) =>{
        setRow(row);
        console.log(row1)

    }


    function iconAcion(cell, row, rowIndex, formatExtraData)
    {


        return (

            <div className='row justify-content-center row-cols-2 row-cols-lg-5 g-2 g-lg-3'>
                <div className="col ">
                    <Youtube row ={row} setEstado={setEstado} />
                </div>
                <br />
                <div className="col ">
                    <Descargar row ={row} setEstado={setEstado} />
                </div>
                <br />
                {/* <div className="col ">
                    <Calificar row ={row} setEstado={setEstado} />
                </div> */}
               
            </div>
            
        );
    }

    const columns = [

        {
            dataField: 'nombre_equipo',
            text: 'Nombre del Equipo'
        },

        {
            dataField: 'nombre_sedes',
            text: 'Sede'
        },

        {
            dataField: 'nombre_desafio',
                text: 'desafios'
        },
        {
            dataField: 'nota',
            text: 'nota'
        },
        {
            dataField: 'anyo',
            text: 'anyo'
        }
        ,
        {
            dataField: 'Aciones',
            text: 'Aciones',
            formatter: iconAcion

        },


        ];
        return (
            <div className='container'>
    
                <ToolkitProvider keyField="id" data={ rows } columns={ columns } search >
                    {
                        props => (
                            <div className='container'>
                                <h6>Ingrese El Equipo :</h6>
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
                                        <ModalAgregar setEstado={setEstado}/>
                                    </div>
                                    <div className="col">
                                        <SeleccionarGanador setEstado={setEstado}/>
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
    
        )


}
export default listar;