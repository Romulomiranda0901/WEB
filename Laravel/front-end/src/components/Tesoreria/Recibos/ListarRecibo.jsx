import React, {useEffect, useState} from 'react'
import { Table} from 'react-bootstrap';
import {FaSave,FaBan, FaEye   } from "react-icons/fa";
import AnularRecibos from "./AnularRecibos";
export default function ListarRecibo()
{
    /*Hooks*/
    const [showModal, setShowModal] = useState(false);
    const handleModalShow = () => setShowModal(true);
    const handleModalClose = () => setShowModal(false);


    return (
        <div>
            <div>

                <div className="row">

                    <div className="col-lg-12 grid-margin stretch-card">
                        <div className="card">
                            <div className="card-body">
                                <div className="table-responsive">
                                    <table className="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Nunero Recibo</th>
                                            <th>Nombre Completo</th>
                                            <th>Moneda</th>
                                            <th>Monto</th>
                                            <th>anulado</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>102030</td>
                                            <td>Aldo Jose Berrios</td>
                                            <td className="text-danger"> Cordobas <i className="mdi mdi-arrow-down"></i>
                                            </td>
                                            <td><label>250</label></td>
                                            <td><label className="badge badge-success">No</label></td>
                                            <td>
                                                <button type="button" className="btn btn-sm btn-primary" onClick={handleModalShow}><FaEye/></button>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>102031</td>
                                            <td>Romulo Miranda</td>
                                            <td className="text-danger">Cordobas<i className="mdi mdi-arrow-down"></i>
                                            </td>
                                            <td>250</td>
                                            <td><label className="badge badge-success">No</label></td>
                                            <td>
                                                <button type="button" className="btn  btn-sm btn-primary"><FaEye/>
                                                </button>

                                            </td>

                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <AnularRecibos showModal={showModal} handleModalClose={handleModalClose} />
        </div>
    )
}