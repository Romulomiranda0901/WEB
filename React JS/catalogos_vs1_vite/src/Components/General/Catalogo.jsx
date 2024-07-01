import React, { useState } from 'react';
import CreateItemForm from './CreateItem';
import EditItemForm from './EditItem';
import ItemList from './ItemList';

const Catalogo = ({ fields, initialItems, createApiUrl, editApiUrl, deleteApiUrl, Name, showCreate, showEditForm, showDeleteForm }) => {
    const [items, setItems] = useState(initialItems);
    const [editingItem, setEditingItem] = useState(null);
    const [search, setSearch] = useState('');
    const [showCreateForm, setShowCreateForm] = useState(false);

    const handleCreate = (item) => {
        setItems([...items, item]);
        setShowCreateForm(false);
    };

    const handleEdit = (updatedItem) => {
        setItems(items.map(item => item.id === updatedItem.id ? updatedItem : item));
        setEditingItem(null);
    };

    const handleDelete = (id) => {
        setItems(items.filter(item => item.id !== id));
    };

    const handleSearch = (term) => {
        setSearch(term);
    };

    const toggleCreateForm = () => {
        setShowCreateForm(!showCreateForm);
        setEditingItem(null);
    };

    const handleEditItemClick = (item) => {
        setEditingItem(item);
        setShowCreateForm(false);
    };

    const cancelCreate = () => {
        setShowCreateForm(false);
    };

    const cancelEdit = () => {
        setEditingItem(null);
    };

    // Filtrar elementos basados en el término de búsqueda
    const filteredItems = items.filter(item =>
        fields.some(field => item[field.name] && item[field.name].toString().toLowerCase().includes(search.toLowerCase()))
    );

    return (
        <div className="container mx-auto my-4">
            <h1 className="text-2xl font-bold mb-4">{Name}</h1>

            <div className="mb-4 flex justify-start">
                {showCreate && (
                    <button
                        className="ml-4 inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"
                        onClick={toggleCreateForm}
                    >
                        Nuevo
                    </button>
                )}
            </div>

            {showCreateForm && showCreate && (
                <CreateItemForm
                    fields={fields}
                    onCreate={handleCreate}
                    onCancel={cancelCreate}
                    createApiUrl={createApiUrl}
                    Name={Name}
                />
            )}
            {editingItem && showEditForm && (
                <EditItemForm
                    fields={fields}
                    item={editingItem}
                    onEdit={handleEdit}
                    onCancel={cancelEdit}
                    editApiUrl={editApiUrl}
                    Name={Name}
                />
            )}
            {!showCreateForm && !editingItem && (
                <ItemList
                    fields={fields}
                    items={filteredItems}
                    onEdit={handleEditItemClick}
                    onDelete={handleDelete}
                    onSearch={handleSearch}
                    search={search}
                    showEditForm={showEditForm}
                    showDeleteForm={showDeleteForm}
                />
            )}
        </div>
    );
};

export default Catalogo;
