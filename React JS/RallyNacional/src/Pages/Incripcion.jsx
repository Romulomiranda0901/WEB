// import React, { useState, useEffect } from 'react'
// import 'bootstrap/dist/css/bootstrap.min.css';
// import Table from 'react-bootstrap/Table';
// import Button from 'react-bootstrap/Button'
// import Card from 'react-bootstrap/Card'
// import Modal from 'react-bootstrap/Modal'
// import Tab from 'react-bootstrap/Tab'
// import Tabs from 'react-bootstrap/Tabs'
// import Form from 'react-bootstrap/Form'
// import Container from 'react-bootstrap/Container'
// import Row from 'react-bootstrap/Row'
// import Col from 'react-bootstrap/Col'
// import AddIcon from '@mui/icons-material/Add';
// import GroupAddIcon from '@mui/icons-material/GroupAdd';
// import Tooltip from '@mui/material/Tooltip';
// import BootTable from '../Components/BootTable'
// import { fetchData, fetchDataDepend, fetchList } from "../Libs/Fetch";
// export default function Incripcion() {
//   // modal
//   const [show, setShow] = useState(false);
//   const handleClose = () => setShow(false);
//   const handleShow = () => setShow(true);

//   // tabs
//   const [key, setKey] = useState('home');
//   // Hooks
//   const [openEdit, setOpenEdit] = useState(false); //abrir o cerrar modal de edicion
//   const [openCreate, setOpenCreate] = useState(false); ////abrir o cerrar modal de agregar
//   const [id, setId] = useState(4544); //Consigue id de la sede que se desea editar o eliminar
//   const [estado, setEstado] = useState(false); //Creado para renderizado automatico cada vez que se realice un cambio en la base de datos
//   const [rows, setRows] = React.useState([]); //Guarda la lista de Sedes
//   const [error, setError] = useState("");
//   const [showError, setShowError] = useState(false);
//   const [values, setValues] = useState({}); //Guarda los nuevos datos de las sedes
//   //Catalogos
//   const [regiones, setRegiones] = useState([]); // Obtines las regiones
//   const [departamentos, setDepartamentos] = useState([]);
//   const [municipios, setMunicipios] = useState([]);
//   const [instituciones, setInstituciones] = useState([]);
//   const [selectInstituiones, setSelectInstituiones] = useState([]);
//   const [selectValues, setSelectValues] = useState({}); //selecionar los nuevos datos de las sedes

//   const [open, setOpen] = React.useState(false);
  
//     /*Eventos: Conseguir nuevos datos de las sedes*/
//     const handleChange = (event) => {
//       //setShowError(false);
//       const {
//         target: { name, value },
//       } = event;
//       setValues((values) => ({ ...values, [name]: value }));
//     };
  
//     useEffect(() => fetchList("sede", setRows), [estado]);
  
//     useEffect(() => fetchList("region", setRegiones), [estado]);
  
//     useEffect(() => fetchList("institucion", setInstituciones), [estado]);
  
//     useEffect(() => fetchDataDepend("region", "departamentos", values.region, setDepartamentos), [values.region]);
  
//     useEffect(() => fetchDataDepend("departamento", "municipios", values.departamento, setMunicipios), [values.departamento]);

// /*abrir modal crear */
// const handleClickOpenCreate = () => {
//   setOpenCreate(true);
// };
// /*cerrar modal*/
// const handleCloseCreate = () => {
//   setOpenCreate(false);
// };
// /*Enviar datos del nuevo registro */
// const handleSubmitCreate = async (event) => {
//   event.preventDefault();
//   const sedes = values;
//   delete sedes["id"];
//   console.log(sedes["nombre"]);
//   if (sedes["nombre"].length < 3) {
//     /*validar la cantidad minima de caracteres para el nombre sede */
//     setError("El nombre de la sede debe contener al menos tres caracteres");
//     setShowError(true);
//   } else {
//     setShowError(false);

//     try {
//       let datos = {
//         nombre: sedes.nombre,
//         institucion_id: sedes.instituciones.id,
//         municipio_id: sedes.municipio.id,
//       };


//       const { response } = await fetchData("sede/crear", {
//           method: "POST",
//           data: datos,
//       });

//       setEstado(!estado);
//       setValues({});
//       setOpenCreate(false);
//     } catch (error) {
//       console.error(error);
//     }
//   }
// };

// /*** Editar ***/

// /* Abrir modal de edicion y obtener datos actuales de la institucion a editar */
// const handleClickOpenEdit = React.useCallback(
//   (idd) => (event) => {
//     setId(idd);
//     var u = rows.find((c) => c.id === idd);
//   //  let d = departamentos.find(c.id ===  u.municipio.)
//     setValues({ id: idd, nombre: u.nombre, instituciones:u.institucion, region:u.region,departamento:u.departamento,municipio:u.municipio }); //Se guardan los datos actuales del registro
// console.log(u)

//     setOpenEdit(true); //Abre modal de edicion
//   },
//   [rows]


// ); console.log(rows);

// /*Cerrar modal de edit */
// const handleCloseEdit = () => {
//   setOpenEdit(false);
// };

//   return (
//     <><div>
//       <h2>Gestion de Inscripción</h2>
//     </div>
//     <br /><br />
//     <div>
//     <Card style={{ width: '100%' }}>
//   <Card.Body>
//     <Tooltip title="Agregar Inscripcción">
//   <Button color="primary" variant="primary" onClick={handleShow}>
//   <AddIcon />
//   </Button>
//   </Tooltip>
//   <br /><br />
//   <div style={{height:350, width: "100%"}}>
//    <BootTable></BootTable>
//   </div>
//     <Modal size="lg" centered show={show} onHide={handleClose}>
//         <Modal.Header closeButton>
//           <Modal.Title>Proceso de Inscripcion</Modal.Title>
//         </Modal.Header>
//         <Modal.Body>
// <Tabs
//       id="controlled-tab-example"
//       activeKey={key}
//       onSelect={(k) => setKey(k)}
//       className="mb-3"
//     >
//       <Tab eventKey="home" title="Inscripcion de Sede">
//       <Container>
//   <Row>
//     <Col sm={4}>
//     <Form.Control
//      id='standart-basic' 
//      placeholder="Nombre de Sede"
//      name="nombre"
//      onChange={handleChange}
//      label="Nombre de la Sede"
//      variant="standard"
//       />
//     </Col>
//     <Col sm={4}>
//       <Form.Select
//       placeholder="Institucion"
//       labelId="demo-simple-select-standard-label"
//       id="demo-simple-select-standard"
//       name="instituciones"
//       value={values.instituciones || ""}
//       onChange={handleChange}
//       >
//         {instituciones.map((value, index) => (
//         <option key={index} value={value}>
//           {value.nombre}
//         </option>
//       ))}
//     </Form.Select>
//     </Col>
//     <Col sm={4}>
//       <Form.Select
//       labelId="demo-simple-select-standard-label"
//       id="demo-simple-select-standard"
//       name="region"
//       value={values.region || ""}
//       onChange={handleChange}>
//       {regiones.map((value, index) => (
//                     <option key={index} value={value}>
//                       {value.nombre}
//                     </option>
//                   ))}
//     </Form.Select>
//     </Col>
//   </Row>
//   <br />
//   <Row>
//   <Col sm={4}>
//       <Form.Select>
//         <option>Departamento</option>
//     </Form.Select>
//     </Col>
//     <Col sm={4}>
//       <Form.Select>
//       <option>Municipio</option>
//     </Form.Select>
//     </Col>
//   </Row>
// </Container>
//       </Tab>
//       <Tab eventKey="profile" title="Inscripcion de Equipo">
//         <Row>
//         <Col sm={3}>
//           <Form.Control placeholder="Nombre Equipo" />
//           </Col>
//           <Col sm={4}>
//           <Form.Control placeholder="Nombre del Participante" />
//           </Col>
//           <Col sm={2}>
//           <Form.Control placeholder="Cedula" />
//           </Col>
//           <Col sm={2}>
//           <Form.Select>
//       <option>Sexo</option>
//     </Form.Select>
//           </Col>
//           <Col sm={1}>
//           <Tooltip title="Añadir Integrante">
//             <Button variant='success'><GroupAddIcon/></Button>
//             </Tooltip>
//           </Col>
//         </Row>
//         <Row>
//         </Row>
//         <br />
//         <Table striped bordered hover size="sm">
//     <thead>
//     <tr>
//       <th></th>
//       <th >Nombre del Participante</th>
//       <th>Cedula</th>
//       <th>Sexo</th>
//     </tr>
//   </thead>
//   <tbody>
//     <tr>
//     </tr>
//     <tr>
//     </tr>
//     <tr>
//     </tr>
//   </tbody>
//     </Table>
//       </Tab>
//       <Tab eventKey="contact" title="Eleccion de Desafio" >
//       <Row>
//       <Col sm={5}>
//           <Form.Select>
//       <option>Desafio</option>
//     </Form.Select>
//           </Col>
//           <Col sm={5}>
//           <Form.Select>
//       <option>Categoria</option>
//     </Form.Select>
//           </Col>
//         </Row>
//       </Tab>
//     </Tabs>
//     <br></br><br />
//         </Modal.Body>
//         <Modal.Footer>
//           <Button variant="secondary" onClick={handleClose}>
//             Cerrar
//           </Button>
//           <Button variant="primary" onClick={handleClose}>
//             Guardar
//           </Button>
//         </Modal.Footer>
//       </Modal>
//   </Card.Body>
// </Card>
//       </div></>
//   )
// }
import React, { useState, useEffect } from 'react';
import Listar from "../Components/Inscripciones/Listar";
import Example from "../Components/Instituciones/modalInstituciones";

export default function Incripcion()
{
    /*Hooks*/

    return(
        <div>

            <Listar/>

        </div>
    )
}