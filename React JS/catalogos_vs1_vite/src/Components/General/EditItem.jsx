import React from 'react';
import { Formik, Form, Field, ErrorMessage } from 'formik';
import * as Yup from 'yup';
import Swal from 'sweetalert2';
import { api } from "../../Services/api.ts";
import { useNavigate } from "react-router-dom";

const EditItem = ({ fields, item, onEdit, onCancel, editApiUrl, Name }) => {
    if (!item) return null;
    const token = localStorage.getItem('token');
    const navigate = useNavigate();

    // Filtrar los campos que se deben mostrar en el formulario
    const formFields = fields.filter(field => field.showInForm);

    // Crear objeto inicial de valores para cada campo, usando los valores actuales del item
    const initialValues = formFields.reduce((acc, field) => {
        acc[field.name] = item[field.name] || '';
        return acc;
    }, {});

    // Crear esquema de validación con Yup basado en los campos del formulario
    const validationSchema = Yup.object().shape(
        formFields.reduce((acc, field) => {
            acc[field.name] = Yup.string().required(`${field.label} es requerido`);
            return acc;
        }, {})
    );

    // Función para manejar el envío del formulario
    const handleSubmit = async (values) => {
            const response = await api.post(editApiUrl, values, token);
            const statusCode = response.statusCode;

            if (statusCode === 200) {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: 'Datos Actualizados',
                    showConfirmButton: false,
                    timer: 1500
                });
                navigate("/dashboard");
            } else {
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: 'Error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }

    };

    return (
        <div className="max-w-4xl mx-auto">
            <h3 className="text-lg leading-6 font-medium text-gray-900 mb-5">Editar {Name}</h3>
            <Formik initialValues={initialValues} validationSchema={validationSchema} onSubmit={handleSubmit}>
                {({ handleSubmit }) => (
                    <Form onSubmit={handleSubmit} className="space-y-4">
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {formFields.map((field) => (
                                <div key={field.name}>
                                    <label htmlFor={field.name} className="block text-sm font-medium text-gray-700">
                                        {field.label}
                                    </label>
                                    <Field
                                        name={field.name}
                                        disabled={field.name === 'id'} // Desactivar el campo si es el ID
                                        as={field.type === 'select' ? 'select' : 'input'}
                                        type={field.type === 'select' ? undefined : field.type}
                                        className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    >
                                        {field.options?.map(option => (
                                            <option key={option.value} value={option.value}>{option.option}</option>
                                        ))}
                                    </Field>
                                    <ErrorMessage name={field.name} component="div" className="text-red-500 text-sm" />
                                </div>
                            ))}
                        </div>
                        <div className="flex justify-end space-x-2">
                            <button
                                type="submit"
                                className="inline-flex justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Editar
                            </button>
                            <button
                                type="button"
                                onClick={onCancel}
                                className="inline-flex justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Cancelar
                            </button>
                        </div>
                    </Form>
                )}
            </Formik>
        </div>
    );
};

export default EditItem;
