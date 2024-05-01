import React, {useEffect, useState} from 'react';
import {fetchList, fetchList2} from "../../Libs/Fetch";
import Row from 'react-bootstrap/Row'
import Col from 'react-bootstrap/Col'
import {Tab} from "@mui/material";

function EquipoFormulario(props)
{
    const { setValue, values } = props;
    const [sedes, setsedes] = useState([]);
    const [desafio, setdesafio] = useState([]);
    const [estado, setEstado] = useState(false);


    const handleChange = (event) => {
        const {target: { name, value },} = event;
        setValue((values) => ({ ...values, [name]: value }));
    };
    useEffect(() => setsedes(props.sedes) ,[]);
    useEffect(() => setdesafio(props.desafio),[]);
    console.log(sedes);



    return(

            <Row>
                <Col sm={6}>
                    <input type="text" className="form-control" id="nombre" name='nombre'   onChange={handleChange}
                           placeholder="Nombre de Equipo"   required pattern={'[A-Za-z ]+'}   title="Solo debe Ingresar letras" />
                    <br />
                    <input type="text" className="form-control" id="anyo" name='anyo'  onChange={handleChange}
                           placeholder="Año"  required pattern={'[0-9]+'} title='Solo debe Ingresar Numero mayor que 0'/>
                </Col>
                <Col sm={6}>
                    <select id="inputState" className="form-select"   onChange={handleChange} name='sede_id' id='sede_id'  required defaultValue='' >
                        <option value='' disabled="disabled">seleccione la Sede</option>
                        {sedes.map((reg) => {
                            return (
                                <option key={reg.sede.id} value={reg.sede.id}>
                                    {reg.sede.nombre}
                                </option>
                            );
                        })}
                    </select>
                    <br />
                    <select id="inputState" className="form-select"   onChange={handleChange} name='desafio_id' id='desafio_id' defaultValue={''} required>
                        <option value={''} disabled="disabled">seleccione el Desafio</option>
                        {desafio.map((reg) => {
                            return (
                                <option key={reg.id} value={reg.id}>
                                    {reg.nombre}
                                </option>
                            );
                        })}
                    </select>
                </Col>
            </Row>

    )
}

export default EquipoFormulario