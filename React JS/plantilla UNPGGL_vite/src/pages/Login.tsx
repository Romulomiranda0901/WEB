import * as Yup from "yup";
import { Formik } from "formik";
import InputLabel from "../components/input/InputLabel.tsx";
import Button from "../components/button/Button.tsx";
import { useNavigate } from "react-router-dom";
import { useAppDispatch } from "../store/store.ts";
import { loginUser } from "../store/authSlice.ts";
import { useEffect } from "react";

function Login() {
    const dispatch = useAppDispatch();
    const navigate = useNavigate();

    useEffect(() => {
        const token = localStorage.getItem('token');
        if (token) {
            navigate("/dashboard");
        }
    }, [navigate]);

    const validationSchema = Yup.object({
        inss: Yup.string().required('Required'),
        password: Yup.string().required('Required'),
    });

    const initialValues = {
        inss: '',
        password: '',
    };

    const onSubmit = async (values: typeof initialValues) => {
        try {
            await dispatch(loginUser(values));
            navigate("/dashboard");
        } catch (error) {
            console.error("Error al iniciar sesión:", error);
            // Aquí puedes manejar el error, como mostrar un mensaje al usuario
        }
    };

    return (
        <section className='bg-gradient-to-r from-[#772D2F] to-[#772D2F] dark:bg-gray-900'>
            <div className='flex items-center justify-center px-6 py-8 mx-auto md:h-screen lg_py-0'>
                <div className='flex flex-col md:flex-row items-center w-full bg-gradient-to-r from-[#BB782A] to-white-80 dark:bg-gray-800 rounded-lg shadow-lg p-8'>
                    <div className='md:w-1/2 text-center'>
                        <div className="flex flex-col items-center">
                            <img className='w-20 h-20 mb-4 rounded-full' src='/img.png' alt='Logo de la empresa'/>
                            <h2 className='text-2xl font-bold text-white mb-2'>¡Fe y Amor Por Mi Pueblo Nicaragüense!</h2>
                        </div>
                    </div>
                    <div className='w-full md:w-1/2'>
                        <div className='bg-opacity-50 bg-gray-800 p-4 w-1/2 h-1/2'>
                            <h1 className='text-3xl font-bold text-white mb-4'>Inicio de Sesion</h1>
                            <Formik
                                initialValues={initialValues}
                                onSubmit={onSubmit}
                                validationSchema={validationSchema}
                            >
                                {({ values, errors, handleChange, handleSubmit }) => (
                                    <form onSubmit={handleSubmit} className='space-y-5'>
                                        <InputLabel label='inss' name='inss' placeholder='12345'
                                                    error={errors.inss} onChange={handleChange} value={values.inss}/>
                                        <InputLabel name='password' label='Contraseña' placeholder='*****'
                                                    type='password' error={errors.password} onChange={handleChange}
                                                    value={values.password}/>
                                        <Button value='Ingresar' type="submit"/>
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

export default Login;
