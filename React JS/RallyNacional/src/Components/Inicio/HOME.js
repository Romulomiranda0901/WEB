import React from 'react';
import { Button } from './Button';
import './Home.css';
// import { Link } from 'react-router-dom';
// import { Link, animateScroll as scroll } from "react-scroll";

export default function Inicio() {
  return (
    <div className='hero-container'>
        <h1>RALLY NACIONAL</h1>
        <p>Te invitamos a Participar</p>
        {/* <div className='hero-btns'>
            <Button
                component={Link} to="informacion"
                className='btns'
                buttonStyle='btn--outline'
                buttonSize='btn--large'
                 
            >
                Comencemos
            </Button> 
             <Button
                className='btns'
                buttonStyle='btn--primary'
                buttonSize='btn--large'
            >
                Ver Reglamentos <i className='far fa-play-circle' />
            </Button>
        </div> */}
    </div>
  )
}
