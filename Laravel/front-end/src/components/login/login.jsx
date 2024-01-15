import React, { useState } from 'react';
import {FaSignInAlt, FaUser} from "react-icons/fa";
import './css/index.css';
import axios from "axios";
import {fetchData} from "../../libs/useAxios";
import { useNavigate } from 'react-router-dom';
import { useSetRecoilState } from 'recoil';
import {usuarioAtom} from "../../libs/RecoilState";


const Login = () => {
    const [estado, setEstado] = useState(false);
    const [inss, setInss] = useState('');
    const [password, setPassword] = useState('');
    const navigate = useNavigate();
    const setUsuario = useSetRecoilState(usuarioAtom);
    const enviarDatos = async (e) =>{
        e.preventDefault()
        try {
            await axios.get(`${process.env.REACT_APP_API_URL}/sanctum/csrf-cookie`).then( async res => {
                const  { response } = await fetchData("login", setEstado,{
                    method: "POST",
                    data: {inss,password},
                });

                if(response.data != null)
                {
                    const usuario = {
                        id_usuario: response.data.data.id_user,
                        id_rol: response.data.data.id_rol,
                        token: response.data.data.token
                    };
                    console.log(response.data.data)
                    setUsuario(usuario);
                  /*  sessionStorage.setItem('auth_token', response.data.data.token);
                    sessionStorage.setItem('auth_name', JSON.stringify(response.data.data.user));*/


                    //setValues({});
                    navigate("/dashboard");
                }

            });

        }catch (error) {
            console.error('Error de inicio de sesión', error);
        }
    }




    return (

        <form id="login-form" className="section__formulario-form align-self-center"
              onSubmit={enviarDatos}>
            <div className="media mt-3 d-flex justify-content-center">

                <div className="media-body">
                    <h6 className="mt-0 fw-bold">Siscoga</h6>
                </div>
            </div>

            <div className="row mb-4">

            </div>
            <hr/>
            <div className="icon d-flex align-items-center justify-content-center">
                <span className="fa fa-user-o"><FaUser/></span>
            </div>
            <div className="row d-flex justify-content-center">
                <div className="form-group col-md-10">

                    <div className="row mb-3">
                        <label htmlFor="name">Inss</label>
                        <input required type="text" className="form-control" id="inss" name="inss"
                               placeholder="Ingres el Usuario"
                               onChange={(e) => setInss(e.target.value)}/>
                    </div>

                </div>
                <div className="form-group col-md-10">
                    <div className="row mb-3">
                        <label htmlFor="password">password </label>
                        <input required type="password" className="form-control" id="password"
                               name="password"
                               placeholder="Ingrese su password"
                               onChange={(e) => setPassword(e.target.value)}/>
                    </div>

                </div>


                <div className="col-md-10 ">
                    <div className="row mb-3">
                        <button type="submit" className="btn btn-primary btn-lg " id="btn-ingresar">
                            <i className="fa fa-sign-in"><FaSignInAlt></FaSignInAlt></i> Ingresar
                        </button>
                    </div>
                </div>
            </div>


        </form>
    )
}
export default Login;