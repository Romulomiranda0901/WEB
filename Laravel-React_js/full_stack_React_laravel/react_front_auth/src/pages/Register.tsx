import {Formik} from "formik";
import InputLabel from "../components/input/InputLabel";
import Button from "../components/button/Button.tsx";
import * as Yup from 'yup';
import {Simulate} from "react-dom/test-utils";
import error = Simulate.error;
import {api} from "../Services/api.ts";
import {Link, useNavigate} from "react-router-dom";
import {loginUser, registerUser} from "../store/authSlice.ts";
import {useSelector} from "react-redux";
import {RootState, useAppDispatch} from "../store/store.ts";
import {useEffect} from "react";


function Register() {
    const dispatch = useAppDispatch();
    const initialvalues = {
        name:'',
        email:'',
        password:'',
        password_confirmation:''
    }
    const navigate = useNavigate();
    const {isLogin}= useSelector((state:RootState )=> state.auth)

    useEffect(()=>{
        if (isLogin){
            navigate("/dashboard")
        }
    },[isLogin])
    const onbsubmit=(values:typeof initialvalues)=>{
        console.log(values)
        const respueta =   dispatch(loginUser(values))

        if (respueta){
            console.log(respueta);
            navigate("/dashboard")
        }

    }

    const validationSchema = Yup.object({

        name: Yup.string()

            .max(30, 'Must be 30 characters or less')

            .required('Required'),

        email: Yup.string().email('Invalid email address').required('Required'),
        password: Yup.string().required('Required'),
        password_confirmation: Yup.string().oneOf([Yup.ref('password'),'la contraseña no coinciden']).required('Required')

    });
    return (
        <section className='bg-gradient-to-r from-[#772D2F] to-[#772D2F] dark:bg-gray-900'>
            <div className='flex items-center justify-center px-6 py-8 mx-auto md:h-screen lg_py-0'>
                <div
                    className='flex flex-col md:flex-row items-center w-full bg-gradient-to-r from-[#BB782A] to-white-80 dark:bg-gray-800 rounded-lg shadow-lg p-8'>
                    {/* Logo y lema de la empresa en la parte izquierda */}
                    <div className='md:w-1/2 text-center md:text-left'>
                        {/* Agrega tu logo aquí */}
                        <img className='w-20 h-20 mb-4 rounded-full' src='ruta_del_logo.png' alt='Logo de la empresa'/>
                        <h2 className='text-2xl font-bold text-white mb-2'>Lema de la empresa</h2>
                        {/*¡Fe y Amor Por Mi Pueblo Nicaragüense!
                            <br/>
                            Incidencias Notificarlas al correo
                            <br/>
                            informatica.sistemas@unpggl.edu.ni*/}
                    </div>

                    {/* Formulario en la parte derecha */}
                    <div className='w-full md:w-1/2'>
                        <div className='bg-opacity-50 bg-gray-800 p-4 w-1/2 h-1/2'>
                            <h1 className='text-3xl font-bold text-white mb-4'>
                                Registrarme
                            </h1>
                            {/* Agrega tu formulario aquí */}
                            <Formik
                                initialValues={initialvalues}
                                onSubmit={onbsubmit}
                                validationSchema = {validationSchema}
                            >
                                {({

                                      values,

                                      errors,

                                      touched,

                                      handleChange,

                                      handleBlur,

                                      handleSubmit,

                                      isSubmitting,


                                  }) => (
                                    <form onSubmit={handleSubmit} className='space-y-5'>
                                        <InputLabel label='Correo' name='email' placeholder='example@gmail.com'
                                                    error={errors.email} onChange={handleChange} value={values.email}/>
                                        <InputLabel name='name' label='Nombre' placeholder='Prueba Prueba'
                                                    error={errors.name} onChange={handleChange} value={values.name}/>
                                        <InputLabel name='password' label='Contraseña' placeholder='*****'
                                                    type='password' error={errors.password} onChange={handleChange}
                                                    value={values.password}/>
                                        <InputLabel name='password_confirmation' label='Confirmar Contraseña'
                                                    placeholder='*****' type='password'
                                                    error={errors.password_confirmation} onChange={handleChange}
                                                    value={values.password_confirmation}/>
                                        <Button value='Registrar' type="submit"/>
                                        <p className='text-sm font-light text-gray-500 dark:text-gray-400'>
                                            Tienes una Cuenta {" "}
                                            <Link to="/login"
                                                  className="font-medium text-indigo-600 hover:underline dark:text-indigo-500">
                                                Iniciar Sesion
                                            </Link>
                                        </p>
                                    </form>
                                )}
                            </Formik>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    );
}

export default Register;