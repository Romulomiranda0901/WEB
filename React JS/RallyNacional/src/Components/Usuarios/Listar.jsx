import React, {useEffect, useState} from 'react'
import axios from 'axios';
import {fetchData, fetchDataDepend, fetchDelete, fetchList} from "../../Libs/Fetch";
import { FaEye, FaTrash } from 'react-icons/fa';
import BootstrapTable from 'react-bootstrap-table-next';
import paginationFactory from 'react-bootstrap-table2-paginator';
import ToolkitProvider, { Search }  from 'react-bootstrap-table2-toolkit/dist/react-bootstrap-table2-toolkit';
// import ModalAgregar from "./AgregarCategoria";
import ModalActualizar from "./Actualizar";

import ModalCrear from "./Crear";

const listar =() =>
 {

     // eslint-disable-next-line react-hooks/rules-of-hooks
     const [rows, setRows] = useState([]);
     // eslint-disable-next-line react-hooks/rules-of-hooks
     const [estado, setEstado] = useState(false);
     // eslint-disable-next-line react-hooks/rules-of-hooks
     const [currentPage, SetcurrentPage] =  useState(1);
     // eslint-disable-next-line react-hooks/rules-of-hooks
     const [todosPerPage, SettodosPerPage] =  useState(1);
     const { SearchBar, ClearSearchButton } = Search;

     // eslint-disable-next-line react-hooks/rules-of-hooks
     useEffect(() => fetchList("user", setRows), [estado]);
     console.log(rows);



     function iconAcion(cell, row, rowIndex, formatExtraData)
     {
 
 
         return (
 
                 <div className='row justify-content-center row-cols-2 row-cols-lg-5 g-2 g-lg-3'>
                     <div className="col ">
                         <ModalActualizar row ={row} setEstado={setEstado} />
                     </div>
                     {/* <div className="col "> <button   className='btn btn-danger'><FaTrash /></button></div> */}
                 </div>
         );
     }


 
 
 
     const columns = [


      {
         dataField: 'usuario',
         text: 'Usuario'
      },

     {
          dataField: 'tipo_rol',
          text: 'Tipo de rol'
    },
         {
         dataField: 'Aciones',
         text: 'Aciones',
         formatter: iconAcion
 
     }];
 

  return (
    <div className='container'>

            <ToolkitProvider keyField="id" data={ rows } columns={ columns } search >
                {
                    props => (
                        <div className='container'>
                            <h6>Ingrese el usuario :</h6>
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

                                    <ModalCrear setEstado={setEstado}/>
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

export default listar

