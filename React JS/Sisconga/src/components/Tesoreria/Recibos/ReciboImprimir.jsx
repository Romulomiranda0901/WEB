// ReciboComponent.js
import React, {useEffect, useState} from 'react'
import '../../../assets/styles/css/recibo.css'
import {useRecoilState} from "recoil";
import {reciboAtom} from "../../../libs/RecoilState";
import { useNavigate } from 'react-router-dom';
import {fetchData} from "../../../libs/useAxios";
import {agregarSubmenusAMenus} from "../../../libs/util";

const ReciboImprimir = () => {
    const [factura, setFactura] = useRecoilState(reciboAtom);
    const navigate = useNavigate();
    const [estado, setEstado] = useState(false);
    const [recibo, setRecibo] = useState([]);

    useEffect(() => {
        // Realiza la redirección si la factura es null
        if (factura === null) {
            const lastLocation = localStorage.getItem('lastLocation');
            if (lastLocation) {
                navigate(lastLocation);
            } else {
                navigate('/tesoreria/NuevoRecibo');
            }
        }
    }, [factura, navigate]);

    useEffect(() => {
        // Almacena la última ubicación antes de la recarga
        localStorage.setItem('lastLocation', '/tesoreria/NuevoRecibo');
    }, []);


    return (
        <div className="recibo">
            <h2>Recibo de Pago</h2>
            <div className="info-factura">
                <p>Fecha: {factura.fecha}</p>
                <p>Cliente: {factura.nombre} {factura.apellidos}</p>
                <p>Carnet: {factura.carnet}</p>
                <p>Carrera: {factura.carrera}</p>
                <p>moneda: {factura.moneda}</p>


            </div>

            <div className="total">
                <p>Total: {factura.monto}</p>
            </div>
        </div>
    );
};

export default ReciboImprimir;
