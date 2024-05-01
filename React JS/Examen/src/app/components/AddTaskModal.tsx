// AddTaskModal.tsx

import React, { useState } from 'react';
import { useDispatch } from 'react-redux';
import { Modal, Button, Form } from 'react-bootstrap'; // Importa componentes de React Bootstrap
import { addTask } from '../store/store';

const AddTaskModal: React.FC = () => {
    const dispatch = useDispatch();
    const [description, setDescription] = useState('');
    const [showModal, setShowModal] = useState(false);

    const handleAddTask = () => {
        if (description.trim() !== '') {
            dispatch(addTask({ id: Date.now(), description }));
            setDescription('');
            setShowModal(false); // Cerrar el modal después de agregar la tarea
        } else {
            alert('Please enter a valid task description.');
        }
    };

    return (
        <>
            <Button variant="primary" onClick={() => setShowModal(true)}>
                Add New Task
            </Button>

            <Modal show={showModal} onHide={() => setShowModal(false)}>
                <Modal.Header closeButton>
                    <Modal.Title>Add New Task</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <Form.Group>
                        <Form.Label>Task Description</Form.Label>
                        <Form.Control
                            type="text"
                            value={description}
                            onChange={(e) => setDescription(e.target.value)}
                            placeholder="Enter task description"
                        />
                    </Form.Group>
                </Modal.Body>
                <Modal.Footer>
                    <Button variant="secondary" onClick={() => setShowModal(false)}>
                        Cancel
                    </Button>
                    <Button variant="primary" onClick={handleAddTask}>
                        Add Task
                    </Button>
                </Modal.Footer>
            </Modal>
        </>
    );
};

export default AddTaskModal;
