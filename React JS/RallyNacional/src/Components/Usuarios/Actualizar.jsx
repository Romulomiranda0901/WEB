import React, {useEffect, useState} from "react";
import 'bootstrap/dist/css/bootstrap.min.css';
import {Modal, Button} from 'react-bootstrap';
import { FaEye,} from "react-icons/fa";
import {fetchData, fetchDataDepend, fetchList, fetchList2} from "../../Libs/Fetch";
import Swal from "sweetalert2";

function ModalActualizar(prop,{setEstado})
{
   // const {datos} = prop.row;
    console.log(prop);

    const [show, setShow] = useState(false);
    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);
    const [values, setValues] = useState({}); //Guarda los nuevos datos
    const [roles, setRoles] =useState([]);
    const [evento, setEvento] = useState([]);


    const handleChange = (event) => {

        const {target: { name, value },} = event;
        setValues((values) => ({ ...values, [name]: value }));
    };
    useEffect(() => fetchList("evento", setEvento), [setEstado]);

    //useEffect(() => fetchList2("user/roles", setRoles), [setEstado]);

    const update = async (event) =>
    {
        event.preventDefault();
        if(values.password === values.password2 )
        {
            const inst = values;
            const { response } = await fetchData(`user/editar/${prop.row.id}`, setEstado,{
                method: "PUT",
                data: inst,
            });

            if(response.data.res === true)
            {
                Swal.fire(
                    'Aviso',
                    response.data.msg,
                    'success'
                )
            }
            else {
                Swal.fire(
                    'Aviso',
                    'Error a Guardar los Datos',
                    'error'
                )

            }

            setValues({});
            // setEstado(!estado);
            handleClose();
        }
        else
        {
            Swal.fire(
                'Aviso',
                'la confirmación de contraseña no coincide',
                'warning'
            )
        }


    }

    return (
        <>
            <Button  className='btn btn-warning' onClick={handleShow}>
                <FaEye/>
            </Button>

            <Modal show={show} onHide={handleClose} centered>
                <Modal.Header closeButton>
                    <Modal.Title>Actualizar Usuario</Modal.Title>
                </Modal.Header>
                <form  onSubmit={(event) => update(event)}>
                    <Modal.Body className="row g-3">

                        <div className="col-md-6">
                            <label htmlFor="nombre">Ingrese nombre de usuario: </label>
                            <input type="text" className="form-control" id="name" name="name" defaultValue={prop.row.usuario} required onChange={handleChange} />

                        </div>
                        <div className="col-md-6">
                            <label htmlFor="evento_id">Evento</label>
                            <select className="form-select" aria-label="evento_id" name='evento_id' id='evento_id'  defaultValue={prop.row.evento_id} onChange={handleChange}>
                                <option value={0} disabled="disabled">seleccione el evento</option>
                                {evento.map((reg) => {
                                    return (
                                        <option key={reg.id} value={reg.id}>
                                            {reg.nombre}
                                        </option>
                                    );
                                })}
                            </select>
                        </div>
                        <div className="col-md-6">
                            <label htmlFor="password">Ingrese contraseña: </label>
                            <input type="password" className="form-control" id="password" name="password"  defaultValue={prop.row.usuario}   required onChange={handleChange} />

                        </div>
                        <div className="col-md-6">
                            <label htmlFor="password2">Confirme contraseña: </label>
                            <input type="password" className="form-control" id="password2" name="password2"  required onChange={handleChange} />

                        </div>



                    </Modal.Body>
                    <Modal.Footer>
                        <Button variant="secondary" onClick={handleClose}>
                            Close
                        </Button>
                        <Button variant="primary" autoFocus type="submit" >
                            Guardar
                        </Button>
                    </Modal.Footer>
                </form>
            </Modal>
        </>
    )
}export default ModalActualizar;