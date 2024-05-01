import React, {useEffect, useState} from 'react';
import {fetchData, fetchDataDepend, fetchDelete, fetchList, fetchList2} from "../../Libs/Fetch";
import {FaSignInAlt, FaUser} from "react-icons/fa";
import Swal from 'sweetalert2';
import { useNavigate } from 'react-router-dom';
import axios from "axios";
import data from "bootstrap/js/src/dom/data";


const Login = () =>
{
    const [estado, setEstado] = useState(false);
    const [values, setValues] = useState({}) // tomos los valores de los textbox del formulario
    const navigate = useNavigate();
    const handleChange = (event) => {
        const {target: { name, value },} = event;
        setValues((values) => ({ ...values, [name]: value }));
    };

   const  signIn = async (event) =>
   {
       event.preventDefault();
       let datos = values;
       if(Object.keys(datos).length ===0) // valida que los campo no esten vacio
       {
           Swal.fire(
               'Aviso',
               'Debe ingresar el usuario y password',
               'error'
           )
       }
       else {


           await axios.get(`${process.env.REACT_APP_API_URL}/sanctum/csrf-cookie`).then( async res => {
                 const  { response } = await fetchData("login", setEstado,{
                   method: "POST",
                   data: datos,
               });

               if(response .data != null)
               {
                   sessionStorage.setItem('auth_token', response.data.data.token);
                   sessionStorage.setItem('auth_name', JSON.stringify(response.data.data.user));
                   setValues({});
                   navigate("/dashboard");
               }

           });



       }

   }


    return (
        <div>
            <main className="main">
                <section className="section__formulario">
                    <form  id="login-form" className="section__formulario-form align-self-center" onSubmit={(event) => signIn(event)}>
                        <div className="media mt-3 d-flex justify-content-center">

                            <div className="media-body">
                                <h6 className="mt-0 fw-bold">Rally Nacional</h6>
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
                                    <label htmlFor="name">Usuario</label>
                                    <input required type="text" className="form-control" id="name" name="name"
                                           placeholder="Ingres el Usuario" onChange={handleChange} />
                                </div>

                            </div>
                            <div className="form-group col-md-10">
                                <div className="row mb-3">
                                    <label htmlFor="password">password </label>
                                    <input required type="password" className="form-control" id="password" name="password"
                                           placeholder="Ingrese su password" onChange={handleChange}/>
                                </div>

                            </div>


                            <div className="col-md-10 ">
                                <div className="row mb-3">
                                    <button type="submit" className="btn btn-primary btn-lg " id="btn-ingresar" >
                                    <i className="fa fa-sign-in"><FaSignInAlt></FaSignInAlt></i> Ingresar
                                </button>
                                </div>
                            </div>
                        </div>


                    </form>
                </section>

            </main>
        </div>


    )
}
 export default Login;


