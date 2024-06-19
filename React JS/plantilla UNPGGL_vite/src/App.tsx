import { createElement, useState } from 'react';
import { createBrowserRouter, RouterProvider } from 'react-router-dom';
import { routes } from './routes/route.tsx';
import {Provider} from "react-redux";
import {persitor, store} from "./store/store.ts";
import {PersistGate} from "redux-persist/integration/react";
import ProtectedRoute from "./pages/ProtectedRoute.tsx";


const router = createBrowserRouter(
    routes.map((route) => ({
        ...route,
        element: route.isProtected ? <ProtectedRoute children={createElement(route.element)} /> : (createElement(route.element))  ,
        children: route.children?.map((child) => ({
            ...child,
            element: child.isProtected ? <ProtectedRoute children={createElement(child.element)} /> : (createElement(child.element))  ,
        })),
    }))
);

function App() {
    const [count, setCount] = useState(0);

    return (
        <Provider store={store}>
          <PersistGate persistor={persitor}>
              <RouterProvider router={router} />
          </PersistGate>
        </Provider>



    );
}

export default App;