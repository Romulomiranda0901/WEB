import React from 'react'
import 'bootstrap/dist/css/bootstrap.min.css';
import { FaEye, FaTrash } from 'react-icons/fa';
import './info.css';
import Card from 'react-bootstrap/Card'
import Container from 'react-bootstrap/Container'
import Row from 'react-bootstrap/Row'
import Col from 'react-bootstrap/Col'
import { Button } from 'react-bootstrap';
import About from './Modalabout';
import Instituciones from './Modalinstituciones'
import Descargas from './ModalDescarga'

export default function info() {
  return (
      <div className='informacion' id='informacion'>
          <Container fluid="md">
              <Row>
                  <Col>
                      <h2>El Rally información Basica</h2>
                  </Col>
              </Row>
          </Container>
          <br></br>
          <Container>
              <Row>
                  <Col>
                      <Card sm={4}>
                          <div className='img-one'> </div>
                          <Card.Body>
                              <Card.Title>Instituciones Participantes</Card.Title>
                              <Card.Text>
                                  Listado de las instituciones que forman parte del Rally Nacional de Innovación.
                              </Card.Text>
                              <Instituciones></Instituciones>
                          </Card.Body>
                      </Card>
                  </Col>
                  <Col>
                      <Card sm={4}>
                          <Card.Body>
                              <div className='img-two'> </div>
                              <Card.Title>Acerca de Nosotros</Card.Title>
                              <Card.Text>
                                  El Rally Nacional es una competencia desarrollada para buscar resolver desafíos...
                              </Card.Text>
                              <About></About>
                          </Card.Body>
                      </Card>
                  </Col>
                  <Col>
                      <Card sm={4}>
                          <div className='img-three'> </div>
                          <Card.Body>
                              <Card.Title>Descarga de Archivos</Card.Title>
                              <Card.Text>
                                  Archivos, reglamentos e indicaciones necesarias para la participacion del Rally Nacional.
                              </Card.Text>

                              <Descargas></Descargas>
                          </Card.Body>
                      </Card>
                  </Col>
              </Row>
          </Container>
      </div>
  )
}
