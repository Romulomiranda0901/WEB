// App.tsx
import { Provider } from 'react-redux';
import { store } from './app/store/store';
import Routes from '../Route.tsx';
import 'bootstrap/dist/css/bootstrap.min.css'; // Importa los estilos de Bootstrap
import './App.css'; // Importa estilos CSS personalizados

const App: React.FC = () => {
    return (
        <Provider store={store}>
            <div className="app-container d-flex justify-content-center align-items-center">
                <Routes />
            </div>
        </Provider>
    );
};

export default App;
