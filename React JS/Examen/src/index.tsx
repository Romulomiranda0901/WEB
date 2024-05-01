import React from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import { BrowserRouter as Router, Route, Switch, Link } from 'react-router-dom';
import { store } from './app/store/store';
import HomePage from './app/pages/HomePage';
import TasksPage from './app/pages/TasksPage';
import ListadoPage from './app/pages/ListadoPage';

const App = () => (
    <Provider store={store}>
        <Router>
            <div>
                <nav>
                    <ul>
                        <li>
                            <Link to="/">Home</Link>
                        </li>
                        <li>
                            <Link to="/tasks">Tasks</Link>
                        </li>
                        <li>
                            <Link to="/listado">Listado</Link>
                        </li>
                    </ul>
                </nav>
                <Switch>
                    <Route exact path="/" component={HomePage} />
                    <Route path="/tasks" component={TasksPage} />
                    <Route path="/listado" component={ListadoPage} />
                </Switch>
            </div>
        </Router>
    </Provider>
);

ReactDOM.render(<App />, document.getElementById('root'));
export default App