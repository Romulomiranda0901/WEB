import { render } from '@testing-library/react'; // Importa render desde @testing-library/react
import '@testing-library/jest-dom'; // Importa las funciones de jest-dom
import HelloMessage from '../../app/components/HelloMessage'; // Importa el componente a probar

// Prueba unitaria para HelloMessage
test('renders message correctly', () => {
    const { getByText } = render(<HelloMessage name="World" />);
    const helloElement = getByText('Hello, World!');
    expect(helloElement).toBeInTheDocument();
});
