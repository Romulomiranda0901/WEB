
// App.js (o tu archivo principal)
import React from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
//import { BrowserRouter as Router, Routes, Route,Navigate } from 'react-router-dom';
import Router from "./routes";
import Dashboard from "./page/DashboardApp";
import Login from "./page/Login";
import PageRecibos from "./page/Tesoreria/Recibos/PageRecibos"
import {RecoilRoot} from "recoil";
import {Routes} from "react-router-dom";
import './App.scss';

const App = () => {
  return (
<RecoilRoot>
  <Router>
    <Routes /> {/* Utiliza el componente Router de react-router-dom */}
  </Router>
</RecoilRoot>
  );
};

export default App;


