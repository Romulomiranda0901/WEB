// TaskList.tsx

import { useSelector } from 'react-redux';
import { RootState } from '../store/store';
import { Task } from '../types/task';
import { Table } from 'react-bootstrap'; // Importa componente Table de React Bootstrap

const TaskList: React.FC = () => {
    // Obtener las tareas del estado de Redux
    const tasks = useSelector((state: RootState) => state.tasks.tasks);

    return (
        <div>
            <h2>Task List</h2>
            <Table striped bordered hover>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody  data-testid="task-list">
                {/* Mapear las tareas y mostrar cada una como una fila de la tabla */}
                {tasks.map((task: Task, index: number) => (
                    <tr key={task.id} >
                        <td>{index + 1}</td>
                        <td>{task.description}</td>
                    </tr>
                ))}
                </tbody>
            </Table>
        </div>
    );
};

export default TaskList;
