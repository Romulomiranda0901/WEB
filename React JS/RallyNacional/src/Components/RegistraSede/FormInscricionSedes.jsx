import React, {useEffect, useState} from 'react';
import {fetchData, fetchDataDepend, fetchDelete, fetchList, fetchList2} from "../../Libs/Fetch";
import Swal from 'sweetalert2';
import { useNavigate } from 'react-router-dom';

const FormInscricionSedes =() =>
{
    const [estado, setEstado] = useState(false);
    const [values, setValues] = useState({})
    const [regiones, setRegiones] = useState([]);
    const [departamentos, setDepartamentos] = useState([]);
    const [municipios, setMunicipios] = useState([])
    const [sedes, setSedes] = useState([])
    const [evento, setEvento] = useState([]);
    const [coordinador, Setcoordinador] = useState([]);
    const navigate = useNavigate();

    // se obtiene los valores de los input
    const handleChange = (event) => {
        const {target: { name, value },} = event;
        setValues((values) => ({ ...values, [name]: value }));
    };
    useEffect(() => fetchList("region", setRegiones), [setEstado]);
    useEffect(() => fetchDataDepend("region", "departamentos", values.region, setDepartamentos), [values.region]);
    useEffect(() => fetchDataDepend("departamento", "municipios", values.departamento, setMunicipios), [values.departamento]);
    useEffect(() => fetchDataDepend("sede", "sedemunicipio", values.municipio_id, setSedes), [values.municipio_id]);
    useEffect(() => fetchList("evento", setEvento), [setEstado]);
    useEffect(() => fetchList2("tipocordinador/coordinador", Setcoordinador), [setEstado]);
    const inscribir = async (event) =>
    {
        event.preventDefault();
        const sedes = values;
        const { response } = await fetchData("sede/evento/crear", setEstado,{
            method: "POST",
            data: sedes,
        });



       if(response.data.res === true)
       {
           Swal.fire(
               'Rally Nacional',
               'Datos Guardado Correctamente',
               'success'
           )
           setValues({});
           navigate("../registrosedes");
       }

       else
       {
           Swal.fire(
               'Rally Nacional',
               response.data.msg,
               'warning'
           )


           setValues({});
           event.target.reset();

       }



    }

    return(

        <div className="container-xxl flex-grow-1 container-p-y">
                <h4 className="fw-bold py-3 mb-4"><span className="text-muted fw-light">Resgistro de Sedes</span>
                </h4>
                <div className="card mb-4">
                    <div className="card-header d-flex align-items-center justify-content-between">
                        <h6 className="mb-0">Registro</h6>

                    </div>
                    <form onSubmit={(event) => inscribir(event)}>
                        <div className="card-body row">
                            <div className="col-md-6">
                                <div className="row mb-3">
                                    <label className="form-label">Region:</label>
                                    <div className="col-sm-10">
                                        <div className="input-group input-group-merge">
                                            <select className="form-select form-control" aria-label="Default select example" name='region'
                                                    id='region' defaultValue={''}  onChange={handleChange} required  >
                                                <option value={''} disabled="disabled">seleccione el Region</option>
                                                {regiones.map((reg) => {
                                                    return (
                                                        <option key={reg.id} value={reg.id}>
                                                            {reg.nombre}
                                                        </option>
                                                    );
                                                })}

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-6">
                                <div className="row mb-3">
                                    <label  className="form-label">Departamento:</label>
                                    <div className="col-sm-10">
                                        <div className="input-group input-group-merge">
                                            <select className="form-select form-control" aria-label="Default select example" name='departamento'
                                                    id='departamento' defaultValue={''}   onChange={handleChange} required>
                                                <option value={''} disabled="disabled">seleccione el Departamento</option>
                                                {departamentos.map((reg) => {
                                                    return (
                                                        <option key={reg.id} value={reg.id}>
                                                            {reg.nombre}
                                                        </option>
                                                    );
                                                })}

                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div className="col-md-6">
                                <div className="row mb-3">
                                    <label  className="form-label">Municipio:</label>
                                    <div className="col-sm-10">
                                        <div className="input-group input-group-merge">
                                            <select className="form-select form-control" aria-label="Default select example" name='municipio_id'
                                                    id='municipio_id' defaultValue={''} onChange={handleChange}  required>
                                                <option value={''} disabled="disabled">seleccione el Municipio</option>
                                                {municipios.map((reg) => {
                                                    return (
                                                        <option key={reg.id} value={reg.id}>
                                                            {reg.nombre}
                                                        </option>
                                                    );
                                                })}

                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div className="col-md-6">
                                <div className="row mb-3">
                                    <label className="form-label">Sede:</label>
                                    <div className="col-sm-10">
                                        <div className="input-group input-group-merge">
                                            <select className="form-select form-control" aria-label="Default select example" name='sede_id'
                                                    id='sede_id' defaultValue={''}  onChange={handleChange} required>
                                                <option value={''} disabled="disabled">seleccione la sede</option>
                                                {sedes.map((reg) => {
                                                    return (
                                                        <option key={reg.id} value={reg.id}>
                                                            {reg.nombre}
                                                        </option>
                                                    );
                                                })}

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div className="col-md-6">
                                <div className="row mb-3">
                                    <label className="form-label">Coordinador de sede:</label>
                                    <div className="col-sm-10">
                                        <div className="input-group input-group-merge">
                                            <select className="form-select form-control" aria-label="Default select example" name='coordinador_id' id='coordinador_id' defaultValue={''} onChange={handleChange} required>
                                                <option value={''} disabled="disabled">seleccione el Coordinador</option>
                                                {coordinador.map((reg) => {
                                                    return (
                                                        <option key={reg.id} value={reg.id}>
                                                            {reg.nombres}  {reg.apellidos}
                                                        </option>
                                                    );
                                                })}

                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div className="col-md-6">
                                <div className="row mb-3">
                                    <label  className="form-label">Evento de Registro</label>
                                    <div className="col-sm-10">
                                        <div className="input-group input-group-merge">
                                            <select className="form-select form-control" aria-label="Default select example" name='evento_id' id='evento_id' defaultValue={''}   onChange={handleChange} required >
                                                <option value={''} disabled="disabled">seleccione el evento</option>
                                                {evento.map((reg) => {
                                                    return (
                                                        <option key={reg.id} value={reg.id}>
                                                            {reg.nombre}
                                                        </option>
                                                    );
                                                })}

                                            </select>
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div className="col-md-6">
                                <div className="row mb-3">
                                    <label className="form-label">Cupos:</label>
                                    <div className="col-sm-10">
                                        <div className="input-group input-group-merge">
                                            <input type="number" className="form-control"
                                                   id="max_participacion"
                                                   name='max_participacion'
                                                   min={0}
                                                   onChange={handleChange} required pattern={'[0-9]+'}
                                                   title='Solo debe Ingresar Numero mayor que 0'
                                            />
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div className="col-md-12">
                                <div className="col-sm-10">
                                    <button type="submit" className="btn btn-primary">Guardar Registro</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>






            </div>
    )
}
 export default FormInscricionSedes;