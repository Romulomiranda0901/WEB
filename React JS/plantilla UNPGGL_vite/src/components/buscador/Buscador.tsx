import  { useState } from 'react';
import { api } from '../../Services/api.ts';

const SearchComponent = ({ onItemSelected }) => {
    const [searchTerm, setSearchTerm] = useState('');
    const [searchResults, setSearchResults] = useState([]);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);

    const handleSearch = async () => {
        setLoading(true);
        try {
            const token = localStorage.getItem('token');
            const response = await api.post("busqueda_cliente_admin",{carnet: searchTerm}, token);

            if (response.data.message !== 'No se encontraron resultados') {
                setSearchResults(response.data);
                setError(null);
            } else {
                console.error('No data found.');
            }
        } catch (error) {
            console.error('Error al realizar la búsqueda:', error);
            setError('Error al realizar la búsqueda.');
        } finally {
            setLoading(false);
        }
    };

    const resetSearch = () => {
        setSearchTerm('');
        setSearchResults([]);
        setLoading(false);
        setError(null);
    };

    return (
        <div className="p-4">
            <input
                className="w-full p-2 rounded border focus:outline-none focus:border-blue-500"
                type="text"
                placeholder="Buscar..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                onKeyPress={(e) => {
                    if (e.key === 'Enter') {
                        handleSearch();
                    }
                }}
            />
            {loading && <div className="text-center mt-2">Cargando...</div>}
            {error && <div className="text-red-500 mt-2">{error}</div>}
            <ul className="mt-2 divide-y divide-gray-200">
                {searchResults?.datos?.map((item) => (
                    <li key={item.id} onClick={() => onItemSelected(searchResults)} className="py-2 cursor-pointer hover:bg-gray-100">
                        {item.nombres}-{item.apellidos}
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default SearchComponent;