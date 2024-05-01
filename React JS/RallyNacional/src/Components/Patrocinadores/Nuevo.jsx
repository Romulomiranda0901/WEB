import React, {useEffect, useState} from 'react';
import { Button, CardActionArea, CardActions, IconButton} from '@mui/material';
import {fetchData, fetchDataDepend, fetchDelete, fetchList, fetchList2} from "../../Libs/Fetch";
import axios from 'axios';
import Swal from "sweetalert2";
import { useNavigate } from 'react-router-dom';

const Nuevo =() =>
{
    const [estado, setEstado] = useState(false);
    const [values, setValues] = useState({})
    const [evento, setEvento] = useState([]);
    const [archivos, setArchivos] = useState(null);
    const navigate = useNavigate();


    const insertarArchivos=async()=>{
        const f = new FormData();

        for (let index = 0; index < archivos.length; index ++){
            f.append("files", archivos[index]);
        }
        console.log(f)
        await axios.post("http://localhost:8000/api/archivosg/crear", values)
            .then(response=>{
                console.log(response.data);
            }).catch(error=>{
                console.log(error);
            })
    }

    // se obtiene los valores de los input
    const handleChange = (event) => {
        const {target: { name, value },} = event;
        setValues((values) => ({ ...values, [name]: value }));
    };
    const handleChangeFile = (event) => {
        const {target: { name, value },} = event;
        setValues((values) => ({ ...values, [name]: event.target.files[0] }));
    };

    useEffect(() => fetchList("evento", setEvento), [setEstado]);

    function mandar(event){
        event.preventDefault()
        const token = sessionStorage.getItem('auth_token');
        const config = {
            headers: {
                'content-type': 'multipart/form-data',
                "Authorization": `Bearer ${token}`
            }
        };
        axios.post(`${process.env.REACT_APP_API_URL}/api/patrocinador/crear`, values, config)
            .then(response=>{
                console.log(response.data);

                    Swal.fire(
                        'Rally Nacional',
                        'Datos Guardado Correctamente',
                        'success'
                    )
                    setValues({});
                    navigate("../registrosedes");





                    setValues({});
                    event.target.reset();


            }).catch(error=>{
            console.log(error);
            Swal.fire(
                'Rally Nacional',
                error,
                'warning'
            )
        })







    }


    return(
        <div className="container-xxl flex-grow-1 container-p-y">
            <h4 className="fw-bold py-3 mb-4"><span className="text-muted fw-light">Patrocinadores</span></h4>
            <div className="card mb-4">
                <div className="card-header d-flex align-items-center justify-content-between">
                    <h6 className="mb-0">Requisitos para los Participantes</h6>
                </div>
                {/* <form onSubmit={(event) => (event)}> */}
                <form onSubmit={mandar} method='POST' encType='multipart/form-data'>
                    <div className="card-body row">
                        <div className="col-md-6">

                            <div className='col mb-5'>
                                <input type="text" className="form-control" id="nombre_patrocinador" name='nombre_patrocinador'  onChange={handleChange}
                                       placeholder="Nombre Patrocinador"   required/>
                            </div>
                            <div className='row mb-5'>
                                <input type="file" name='imagen' id='imagen' onChange={handleChangeFile}/>
                            </div>
                            <div>
                                <Button variant="contained" color="primary" autoFocus type="submit">
                                    Subir Archivos
                                </Button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    )
}
export default Nuevo;