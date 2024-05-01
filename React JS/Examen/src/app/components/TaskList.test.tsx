import { render } from '@testing-library/react';
import { Provider } from 'react-redux';
import { store } from '../store/store';
import TaskList from '../components/TaskList';

describe('TaskList Component', () => {
    it('renders task list correctly', () => {
        const { getByTestId } = render(
            <Provider store={store}>
                <TaskList />
            </Provider>
        );

        const taskListElement = getByTestId('task-list');
        expect(taskListElement).toBeTruthy(); // Verificar si el elemento existe
        // Puedes continuar con más aserciones aquí
    });
});
