// Route.tsx

import  { useState } from 'react';
import { Navbar, Container, Nav } from 'react-bootstrap';
import { BiHome, BiTask, BiListUl } from 'react-icons/bi';
import 'bootstrap/dist/css/bootstrap.min.css';

import HomePage from '/src/app/pages/HomePage';
import TasksPage from './src/app/pages/TasksPage';
import ListadoPage from './src/app/pages/ListadoPage';

const Routes: React.FC = () => {
    const [currentPage, setCurrentPage] = useState('home');

    const renderPage = () => {
        switch (currentPage) {
            case 'home':
                return <HomePage />;
            case 'tasks':
                return <TasksPage />;
            case 'listado':
                return <ListadoPage />;
            default:
                return <HomePage />;
        }
    };

    return (
        <div className="mt-5">
            <Navbar bg="light" expand="lg" className="mb-4">
                <Container>
                    <Navbar.Brand href="#">Examen</Navbar.Brand>
                    <Navbar.Toggle aria-controls="basic-navbar-nav" />
                    <Navbar.Collapse id="basic-navbar-nav">
                        <Nav className="me-auto">
                            <Nav.Link
                                className={currentPage === 'home' ? 'active' : ''}
                                onClick={() => setCurrentPage('home')}
                            >
                                <BiHome /> Home
                            </Nav.Link>
                            <Nav.Link
                                className={currentPage === 'tasks' ? 'active' : ''}
                                onClick={() => setCurrentPage('tasks')}
                            >
                                <BiTask /> Tasks
                            </Nav.Link>
                            <Nav.Link
                                className={currentPage === 'listado' ? 'active' : ''}
                                onClick={() => setCurrentPage('listado')}
                            >
                                <BiListUl /> Listado
                            </Nav.Link>
                        </Nav>
                    </Navbar.Collapse>
                </Container>
            </Navbar>

            <Container>
                <main>{renderPage()}</main>
            </Container>
        </div>
    );
};

export default Routes;
