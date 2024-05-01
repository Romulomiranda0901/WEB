
import './App.css';
import {BrowserRouter,Routes,Route} from "react-router-dom";
import ShowProducts from "./components/ShowProducts";
import CreateProducts from "./components/CreateProducts";
import EditProducts from "./components/EditProducts";


function App() {
  return (
    <div className="App">
        <BrowserRouter>
            <Routes>
                <Route path='/' element={ <ShowProducts/> }/>
                <Route path='/create' element={ < CreateProducts/> } />
                <Route path='/edit/:id' element={<EditProducts/>}/>

            </Routes>
        </BrowserRouter>

    </div>
  );
}

export default App;
