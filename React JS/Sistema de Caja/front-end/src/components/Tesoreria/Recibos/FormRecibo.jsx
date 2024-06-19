import  { useState } from 'react';
import {useRecoilState, useSetRecoilState} from "recoil";
import {reciboAtom} from "../../../libs/RecoilState";
import {FaEye,FaUserPlus } from "react-icons/fa";
import AgregaEstudiante from "./AgregaEstudiante";
import React from "react";
import ReciboImprimir from "./ReciboImprimir";
import { useNavigate } from 'react-router-dom';

export default function FormRecibo()
{
    /*Hooks*/
    const [showModal, setShowModal] = useState(false);
    const handleModalShow = () => setShowModal(true);
    const handleModalClose = () => setShowModal(false);

    const [estudiante, setEstudiante] = useState({
        nombre: '',
        apellidos: '',
        carnet: ''


    });
    const setFactura = useSetRecoilState(reciboAtom);
    const navigate = useNavigate();


    // Datos de prueba
    const handleGuardarEstudiante = (nuevoEstudiante) => {
        setEstudiante(nuevoEstudiante);
        handleModalClose();
    };



    const handleGuardarClick = () => {
        // Realiza acciones de guardado aquí
        // Puedes enviar los datos al servidor, almacenarlos en una base de datos, etc.

        // Ejemplo: Actualiza el estado de la factura
        const nuevaFactura = {
            carnet: '001A',
            nombre: 'Victor',
            apellidos: 'Valdes',
            carrera: 'Diseño Grafico',
            moneda: 'cordoba',
            mes_pagado: 'Enero',
            tipo: 'Arancel',
            monto: '250.00',
            fecha: '25/12/2023'
        }

        setFactura(nuevaFactura);
        navigate('/tesoreria/Recibo');

    };

    return (
        <div className="col-12 grid-margin">
            <div className="card">
                <div className="card-body">
                    <h4 className="card-title">Recibos</h4>
                    <form className="formFactura">
                        <p className="card-description"> Datos del Estudiantes </p>
                        <div className="row">
                            <div className="col-6">
                                <div className="row">

                                    <label className="col-3 col-form-label mt-2">Carnet: </label>

                                    <div className="col">
                                        <div className="input-group">
                                            <input type="text" className="form-control" placeholder="Username"
                                                   aria-label="Username"/>
                                            <button className="btn btn-sm btn-primary" type="button"  onClick={handleModalShow}><FaUserPlus/>
                                            </button>
                                        </div>

                                    </div>
                                </div>

                            </div>


                        </div>
                        <div className="row">
                            <div className="col-md-6">
                                <div className="row">
                                    <label className="col-3 col-form-label mt-2">Nombres: </label>
                                    <div className="col-sm-9">
                                        <input type="text" className="form-control" placeholder="Nombres"
                                               aria-label="Nombres"/>
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-6">
                                <div className="row">
                                    <label className="col-3 col-form-label mt-2">Apellidos: </label>
                                    <div className="col-sm-9">
                                        <input type="text" className="form-control" placeholder="Apellidos"
                                               aria-label="Apelliods"/>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <p className="card-description">
                            Datos de Pago
                        </p>
                        <div className="row">
                            <div className="col-md-6">
                                <div className="row">
                                    <label className="col-3 col-form-label mt-2">Tipo de Moneda: </label>
                                    <div className="col-sm-9">
                                        <select className="form-control" id="moneda">
                                            <option>Cordobas</option>
                                            <option>Dolar</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-6">
                                <div className="row">
                                    <label className="col-3 col-form-label mt-2">Tipo de Cambio: </label>
                                    <div className="col-sm-9">
                                        <input type="text" className="form-control" placeholder="Tipo de Cambio"
                                               aria-label="Cambio"/>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div className="row">
                            <div className="col-md-6">
                                <div className="row">
                                    <label className="col-3 col-form-label mt-2">Tipo de Pago: </label>
                                    <div className="col-sm-9">
                                        <select className="form-control" id="tipoPago">
                                            <option>Arancel</option>
                                            <option>Otros</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-6">
                                <div className="row">
                                    <label className="col-3 col-form-label mt-2">Mes a Pagar: </label>
                                    <div className="col-sm-9">
                                        <select className="form-control" id="mesPagar">
                                            <option>Enero</option>
                                            <option>Febrero</option>
                                            <option>Marzo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div className="row">
                            <div className="col-md-6">
                                <div className="row">
                                    <label className="col-3 col-form-label mt-2">Monto a pagar: </label>
                                    <div className="col-sm-9">
                                        <input type="text" className="form-control" placeholder="monto"
                                               aria-label="monto" id="monto" name="monto"/>
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-6">
                                <div className="row">
                                    <label className="col-3 col-form-label mt-2">Monto Letra: </label>
                                    <div className="col-sm-9">
                                        <input type="text" className="form-control" placeholder="letra"
                                               aria-label="letra" id="letra_monto" name="letra_monto"/>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div className="form_botones">
                            <button type="button" className="btn btn-gradient-primary mr-2" onClick={handleGuardarClick}>Guardar</button>
                            <button className="btn btn-danger">Cancel</button>
                        </div>

                    </form>
                </div>

            </div>
            <AgregaEstudiante showModal={showModal} handleModalClose={handleModalClose} />


        </div>
    )
}