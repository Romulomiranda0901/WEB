import React from 'react'
import Card from 'react-bootstrap/Card'
import Container from 'react-bootstrap/Container'
import Row from 'react-bootstrap/Row'
import Col from 'react-bootstrap/Col'
import Modalsponsor from './modalsponsor'
import './patrocinadores.css'

export default function patrocinadores() {
  return (
    <div className='container'>
          <Container fluid="md">
                <Row>
                    <Col>
                    <Card sm={4} md={12}>
                    <div className='banner'></div>
                        <Card.Body>
                            
                            <div>
                                <Modalsponsor></Modalsponsor>
                            </div>
                        </Card.Body>
                    </Card>
                    </Col>
                </Row>
            </Container>
    </div>
  )
}