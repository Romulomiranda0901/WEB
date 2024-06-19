import React from 'react';
import { Formik, Form, Field, ErrorMessage } from 'formik';
import * as Yup from 'yup';
import Swal from 'sweetalert2';

const EditItem = ({ fields, item, onEdit, onCancel, editApiUrl  }) => {
    if (!item) return null;

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
        try {
            // Aquí podrías realizar una solicitud a una API para editar el item
            onEdit(values);
            Swal.fire('Editado!', 'El item ha sido editado.', 'success');
            onClose();
        } catch (error) {
            Swal.fire('Error!', 'No se pudo editar el item.', 'error');
        }
    };

    return (
        <div className="max-w-lg mx-auto">
            <h3 className="text-lg leading-6 font-medium text-gray-900 mb-5">Editar Item</h3>
            <Formik initialValues={initialValues} validationSchema={validationSchema} onSubmit={handleSubmit}>
                {({ handleSubmit }) => (
                    <Form onSubmit={handleSubmit} className="space-y-4">
                        {formFields.map((field) => (
                            <div key={field.name}>
                                <label htmlFor={field.name} className="block text-sm font-medium text-gray-700">
                                    {field.label}
                                </label>
                                {field.type === 'text' || field.type === 'number' || field.type === 'date' ? (
                                    <Field
                                        name={field.name}
                                        type={field.type}
                                        className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    />
                                ) : (
                                    <Field
                                        as="select"
                                        name={field.name}
                                        className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    >
                                        <option value="">Seleccione...</option>
                                        {field.options?.map(option => (
                                            <option key={option} value={option}>{option}</option>
                                        ))}
                                    </Field>
                                )}
                                <ErrorMessage name={field.name} component="div" className="text-red-500 text-sm" />
                            </div>
                        ))}
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
