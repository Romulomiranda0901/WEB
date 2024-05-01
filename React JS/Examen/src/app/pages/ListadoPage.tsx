import { useState, useEffect } from 'react';
import LoadingSpinner from '../components/LoadingSpinner';
import { Table, Image } from 'react-bootstrap'; // Importa el componente Image de react-bootstrap
import 'bootstrap/dist/css/bootstrap.min.css';

const ListadoPage: React.FC = () => {
    const [elements, setElements] = useState<any[]>([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        fetch('https://6172cfe5110a740017222e2b.mockapi.io/elements')
            .then((response) => response.json())
            .then((data) => {
                setElements(data);
                setLoading(false);
            });
    }, []);

    if (loading) {
        return <LoadingSpinner />;
    }

    return (
        <div className="container mt-5">
            <h1>Listado Page</h1>
            <Table striped bordered hover>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Avatar</th>
                </tr>
                </thead>
                <tbody>
                {elements.map((element, index) => (
                    <tr key={element.id}>
                        <td>{index + 1}</td>

                        <td>{element.name}</td>
                        <td>
                            <Image src={element.avatar} alt={`Avatar de ${element.name}`} thumbnail/>
                        </td>

                    </tr>
                ))}
                </tbody>
            </Table>
        </div>
    );
};

export default ListadoPage;
