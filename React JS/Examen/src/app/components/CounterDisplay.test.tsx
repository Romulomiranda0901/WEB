// Importa las librerías necesarias

import { render } from '@testing-library/react';
import CounterDisplay from '../components/CounterDisplay';
import { Provider } from 'react-redux';
import { store } from '../../app/store/store';

describe('CounterDisplay Component', () => {
    it('renders counter value correctly', () => {
        // Renderiza el componente CounterDisplay dentro de un Provider con el store
        const { getByTestId } = render(
            <Provider store={store}>
                <CounterDisplay />
            </Provider>
        );

        // Encuentra el elemento que contiene el valor del contador (usando getByTestId)
        const countElement = getByTestId('counter-value');

        // Verifica que el elemento esté presente en el documento
        expect(countElement).toBeTruthy(); // Utiliza toBeTruthy en lugar de toBeInTheDocument

        // Obtiene el texto del elemento que contiene el valor del contador
        const countValueText = countElement.textContent;

        // Verifica que el texto contiene un número (puede ser más flexible en la verificación)
        expect(countValueText).toMatch(/\d+/); // Verifica que el texto contiene al menos un dígito
    });
});
