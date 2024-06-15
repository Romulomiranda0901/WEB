import React, { useState } from 'react';
import { Container, Card, Row, Col, Button } from 'react-bootstrap';
import { FaHome, FaWarehouse, FaFileAlt, FaBox, FaTruck, FaBalanceScale, FaBuilding, FaSignInAlt, FaSignOutAlt } from 'react-icons/fa';
import EntryForm from '../components/EntryForm';
import ExitForm from '../components/ExitForm';
import Inventory from '../components/Inventory';
import Reports from '../components/Reports';
import ProductManagement from '../components/ProductManagement';
import ProviderManagement from '../components/ProviderManagement';
import UnitManagement from '../components/UnitManagement';
import DependenciasManagement from '../components/DependenciasManagement';

const Kardex_Page = () => {
    const [entries, setEntries] = useState([]);
    const [inventory, setInventory] = useState({});
    const [products, setProducts] = useState([]);
    const [providers, setProviders] = useState([]);
    const [units, setUnits] = useState([]);
    const [dependencies, setDependencies] = useState([]);
    const [view, setView] = useState('home');
    const [entryView, setEntryView] = useState('entry'); // New state for entry view

    const addEntry = (entryDataList) => {

        // Iterate over the list of entry data and add each entry
        entryDataList.forEach(entryData => {
            const { product, quantity, value, provider, type, date, dependency } = entryData;
            const entry = {
                product,
                quantity: parseInt(quantity),
                value: parseFloat(value),
                provider: provider,
                type: type,
                date: date ,
                dependency: dependency
            };

            // Add entry to the entries list
            setEntries(prevEntries => [...prevEntries, entry]);

            // Update inventory
            updateInventory(entry);
        });

    };

    const updateInventory = (entry) => {
        const { product, quantity, type, value } = entry;

        setInventory(prevInventory => {
            const newInventory = { ...prevInventory };

            if (!newInventory[product]) {
                newInventory[product] = { quantity: 0, value: 0 };
            }

            if (type === 'Entrada') {
                newInventory[product].quantity += parseInt(quantity);
                newInventory[product].value += parseFloat(value);
            } else if (type === 'Salida') {
                newInventory[product].quantity -= parseInt(quantity);
                newInventory[product].value -= parseFloat(value);
            }

            return newInventory;
        });
    };

    const calculateTotalValue = () => {
        return Object.values(inventory).reduce((acc, item) => acc + item.value, 0).toFixed(2);
    };

    const renderCard = (icon, title, description, onClick) => (
        <Col md={4} className="mb-3">
            <Card className="text-center h-100" onClick={onClick}>
                <Card.Body>
                    {icon}
                    <Card.Title>{title}</Card.Title>
                    <Card.Text>{description}</Card.Text>
                </Card.Body>
            </Card>
        </Col>
    );

    return (
        <div>
            <Container>
                {view === 'home' && (
                    <div className="text-center">
                        <h1>Bienvenido al Sistema Kardex</h1>
                    </div>
                )}
                <Row className="mb-4">
                    {renderCard(<FaHome size={50} />, 'Home', 'Página principal', () => setView('home'))}
                    {renderCard(<FaWarehouse size={50} />, 'Inventario', 'Ver inventario', () => setView('inventory'))}
                    {renderCard(<FaFileAlt size={50} />, 'Reportes', 'Ver reportes', () => setView('reports'))}
                    {renderCard(<FaBox size={50} />, 'Productos', 'Gestionar productos', () => setView('products'))}
                    {renderCard(<FaTruck size={50} />, 'Proveedores', 'Gestionar proveedores', () => setView('providers'))}
                    {renderCard(<FaBalanceScale size={50} />, 'Unidades de Medida', 'Gestionar unidades de medida', () => setView('units'))}
                    {renderCard(<FaBuilding size={50} />, 'Dependencias', 'Gestionar dependencias', () => setView('dependencies'))}
                    {renderCard(<FaSignInAlt size={50} />, 'Entrada', 'Gestionar entradas de productos', () => { setView('entry'); setEntryView('entry'); })}
                    {renderCard(<FaSignOutAlt size={50} />, 'Salida', 'Gestionar salidas de productos', () => { setView('entry'); setEntryView('exit'); })}
                </Row>

                {view === 'entry' && entryView === 'entry' && <EntryForm addEntry={addEntry} products={products} providers={providers} dependencies={dependencies} />}
                {view === 'entry' && entryView === 'exit' && <ExitForm addEntry={addEntry} products={products} dependencies={dependencies} />}
                {view === 'inventory' && <Inventory inventory={inventory} totalValue={calculateTotalValue()} />}
                {view === 'reports' && <Reports entries={entries} />}
                {view === 'products' && <ProductManagement products={products} setProducts={setProducts} units={units} />}
                {view === 'providers' && <ProviderManagement providers={providers} setProviders={setProviders} />}
                {view === 'units' && <UnitManagement units={units} setUnits={setUnits} />}
                {view === 'dependencies' && <DependenciasManagement dependencies={dependencies} setDependencies={setDependencies} />}
            </Container>
        </div>
    );
};

export default Kardex_Page;
