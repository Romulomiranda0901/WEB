import React, { useState } from 'react';
import Header from './Header';
import AddEntryForm from './AddEntryForm';
import Inventory from './Inventory';
import Reports from './Reports';
import ProductManagement from './ProductManagement';
import ProviderManagement from './ProviderManagement';
import UnitManagement from './UnitManagement';
import DependenciasManagement from './DependenciasManagement';
import { Container, ButtonGroup, Button } from 'react-bootstrap';
import { FaHome, FaWarehouse, FaFileAlt, FaBox, FaTruck, FaBalanceScale, FaBuilding } from 'react-icons/fa';
import '../App.css';

const Kardex_Page = () => {
    const [entries, setEntries] = useState([]);
    const [inventory, setInventory] = useState({});
    const [products, setProducts] = useState([]);
    const [providers, setProviders] = useState([]);
    const [units, setUnits] = useState([]);
    const [dependencies, setDependencies] = useState([]);
    const [view, setView] = useState('home');

    const addEntry = (entry) => {
        setEntries([...entries, entry]);
        updateInventory(entry);
    };

    const updateInventory = (entry) => {
        const newInventory = { ...inventory };
        const { product, quantity, type, value } = entry;

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

        setInventory(newInventory);
    };

    const calculateTotalValue = () => {
        return Object.values(inventory).reduce((acc, item) => acc + item.value, 0).toFixed(2);
    };

    return (
        <div className="App">
            <Header />
            <Container>
                <ButtonGroup className="mb-4">
                    <Button variant="secondary" onClick={() => setView('home')}>
                        <FaHome /> Home
                    </Button>
                    <Button variant="secondary" onClick={() => setView('inventory')}>
                        <FaWarehouse /> Inventario
                    </Button>
                    <Button variant="secondary" onClick={() => setView('reports')}>
                        <FaFileAlt /> Reportes
                    </Button>
                    <Button variant="secondary" onClick={() => setView('products')}>
                        <FaBox /> Productos
                    </Button>
                    <Button variant="secondary" onClick={() => setView('providers')}>
                        <FaTruck /> Proveedores
                    </Button>
                    <Button variant="secondary" onClick={() => setView('units')}>
                        <FaBalanceScale /> Unidades de Medida
                    </Button>
                    <Button variant="secondary" onClick={() => setView('dependencies')}>
                        <FaBuilding /> Dependencias
                    </Button>
                </ButtonGroup>
                {view === 'home' && <AddEntryForm addEntry={addEntry} products={products} providers={providers} dependencies={dependencies} />}
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
