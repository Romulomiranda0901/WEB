import React, {useEffect, useState} from 'react';
import {fetchList} from "../../Libs/Fetch";

function TableRows({rowsData, deleteTableRows, handleChange,sexo,etnias }) {
    const [genero, setgenero] = useState([]);
    const [etnia, setEtnias] = useState([]);
    const [estado, setEstado] = useState(false);
    const [values, setValues] = useState({});
    const [isChecked, setIsChecked] = useState('');


    useEffect(() => setgenero(sexo), [setEstado]);
    useEffect(() => setEtnias(etnias), [setEstado]);

    return(
        
        rowsData.map((data, index)=>{
            const {coordinador, nombres, apellidos, cedula }= data;

            return(
                <tr key={index}>
                    <td >
                        <input className="form-check-input" type="radio" name="coordinador" id="coordinador"
                            value={coordinador}    onChange={(evnt)=>(handleChange(index, evnt))} />

                    </td>
                <td>
                <input type="text" value={nombres} id="nombres" name='nombres' onChange={(evnt)=>(handleChange(index, evnt))} className="form-control" placeholder="Nombres" required   pattern={'[A-Za-z ]+'}   title="Solo debe Ingresar letras"/>
               {/* <input type="text" value={nombres} onChange={(evnt)=>(handleChange(index, evnt))} name="nombres" className="form-control"/> */}
                </td>

                <td>
                    <input type="text" value={apellidos} id="apellidos" name='apellidos' onChange={(evnt)=>(handleChange(index, evnt))} className="form-control" placeholder="apellidos" required   pattern={'[A-Za-z ]+'}   title="Solo debe Ingresar letras"/>
                </td>
                <td>
                    <input type="text" value={cedula} id="cedula" name='cedula' onChange={(evnt)=>(handleChange(index, evnt))} className="form-control" placeholder="cedula" required pattern={'[0-9]{3}-[0-9]{6}-[0-9]{4}[A-Za-z]{1}'}   title="Debe Ingresar el sigiente Formato ###-######-####L"/>
                </td>
                <td>
                    <select id="inputState" className="form-select" name='genero_id' onChange={(evnt)=>(handleChange(index, evnt))} >
                    <option>Seleccione el genero</option>
                    {genero.map((sexo) => {
                        return (
                            <option key={sexo.id} value={sexo.id}>
                                {sexo.nombre}
                            </option>
                        );
                    })}
                </select>
                </td>

                    <td>
                        <select id="inputState" className="form-select" name='grupo_etnicos_id' onChange={(evnt)=>(handleChange(index, evnt))} >
                            <option>Seleccione la etnia</option>
                            {etnia.map((etnias) => {
                                return (
                                    <option key={etnias.id} value={etnias.id}>
                                        {etnias.nombre}
                                    </option>
                                );
                            })}
                        </select>
                    </td>
                <td><button className="btn btn-outline-danger" onClick={()=>(deleteTableRows(index))}>x</button></td>
            </tr>
            )
        })
        )
    
    }
    export default TableRows;