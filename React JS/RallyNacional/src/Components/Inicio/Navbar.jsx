import React, { useState, useEffect } from 'react';
import { Button } from './Button';
import { Link } from 'react-router-dom';
import { FaBars, FaTrash } from 'react-icons/fa';
import './Navbar.css';
import { color } from '@mui/system';

export default function Navbar() {
    const [click, setClick] = useState(false);
    const [button, setButton] = useState(true);
  
    const handleClick = () => setClick(!click);
    const closeMobileMenu = () => setClick(false);
  
    const showButton = () => {
      if (window.innerWidth <= 960) {
        setButton(false);
      } else {
        setButton(true);
      }
    };
  
    useEffect(() => {
      showButton();
    }, []);
  
    window.addEventListener('resize', showButton);
  return (
    <>
    <nav className='navbar'>
      <div className='navbar-container'>
          <div className='logo'></div>

        <div className='menu-icon' onClick={handleClick}>
          <FaBars></FaBars>

        </div>
        <ul className={click ? 'nav-menu active' : 'nav-menu'}>
          <li className='nav-item'>
            <Link to='/inicio' className='nav-links' onClick={closeMobileMenu}>
              Inicio
            </Link>
          </li>
          {/* <li className='nav-item'>
            <Link
              to='/services'
              className='nav-links'
              onClick={closeMobileMenu}
            >
              Patrocinadores
            </Link>
          </li>
          <li className='nav-item'>
            <Link
              to='/products'
              className='nav-links'
              onClick={closeMobileMenu}
            >
              Descargas
            </Link>
          </li> */}

          <li>
            <Link
              exact 
              strict
              to='/dashboard'
              className='nav-links'
              
            >
              <strong >Inicio de sesión</strong>
            </Link>
          </li>
          {/* <li>
            <Link
            exact 
            strict
            to='/RegistroCuenta'
            className='nav-links'
            >
            <strong> Registrarse</strong>
            </Link>
          </li> */}
        </ul>
      </div>
    </nav>
  </>
  )
}
