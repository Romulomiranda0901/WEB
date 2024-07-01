import React from 'react';

const ItemList = ({ fields, items, onEdit, onDelete, onSearch, search, showEditForm, showDeleteForm }) => {
    const tableFields = fields.filter(field => field.showInTable);

    return (
        <div>
            {/* Barra de búsqueda */}
            <div className="mb-4 flex justify-end">
                <div className="relative">
                    <input
                        type="text"
                        placeholder="Buscar..."
                        value={search}
                        onChange={(e) => onSearch(e.target.value)}
                        className="block w-64 px-3 py-1.5 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    />
                    <div className="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg className="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fillRule="evenodd" d="M12.293 14.707a8 8 0 111.414-1.414l4.387 4.387a1 1 0 01-1.414 1.414l-4.387-4.387zm-1.883-2.1a6 6 0 100-12 6 6 0 000 12z" clipRule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>

            {/* Tabla de elementos */}
            <div className="overflow-x-auto">
                <table className="min-w-full bg-white border border-gray-300 rounded-md shadow-sm">
                    <thead className="bg-gray-200">
                    <tr>
                        {/* Encabezados de columna */}
                        {tableFields.map((field) => (
                            <th key={field.name} className="py-2 px-4 text-left text-sm font-medium text-gray-900">
                                {field.label}
                            </th>
                        ))}
                        <th className="py-2 px-4 text-left text-sm font-medium text-gray-900">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    {/* Contenido de la tabla */}
                    {items.length === 0 ? (
                        <tr>
                            <td colSpan={tableFields.length + 1} className="py-4 px-4 text-center text-gray-500">
                                No se encontraron resultados
                            </td>
                        </tr>
                    ) : (
                        items.map((item) => (
                            <tr key={item.id} className="border-t border-gray-300">
                                {/* Columnas de datos */}
                                {tableFields.map((field) => (
                                    <td key={field.name} className="py-2 px-4 text-sm text-gray-700">
                                        {item[field.name]}
                                    </td>
                                ))}
                                {/* Columna de acciones */}
                                <td className="py-2 px-4 text-sm text-gray-700 space-x-2">
                                    {/* Botón Editar */}
                                    {showEditForm && (
                                    <button
                                        onClick={() => onEdit(item)}
                                        className="inline-flex justify-center rounded-md border border-transparent shadow-sm px-2 py-1 bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                    >
                                        Editar
                                    </button>
                                    )}
                                    {/* Botón Eliminar */}
                                    {showDeleteForm && (
                                    <button
                                        onClick={() => onDelete(item.id)}
                                        className="inline-flex justify-center rounded-md border border-transparent shadow-sm px-2 py-1 bg-red-600 text-white text-sm font-medium hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                    >
                                        Eliminar
                                    </button>
                                    )}
                                </td>
                            </tr>
                        ))
                    )}
                    </tbody>
                </table>
            </div>
        </div>
    );
};

export default ItemList;
