import React from 'react';
import { Navbar } from 'react-bootstrap';

const Header = () => {
    return (
        <Navbar bg="dark" variant="dark" className="mb-4">
            <Navbar.Brand href="#">Kardex de Inventario</Navbar.Brand>
        </Navbar>
    );
};

export default Header;
