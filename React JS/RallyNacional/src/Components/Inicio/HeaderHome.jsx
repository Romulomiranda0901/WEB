

import React from 'react'
import Navbar from '../Inicio/Navbar'
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom';
import Inicio from './HOME'
import Info from './info'
import Descarga from './descarga'
import Footer from './Footer'
import Patrocinadores from './patrocinadores';

export default function HeaderHome() {
  return (
  <div>
 <Navbar></Navbar>
 <div>
 <Inicio></Inicio>
 <br></br>
 <Info></Info>
 </div>
 <br />
 <div>
   <Patrocinadores></Patrocinadores>
 </div>
 <br />
 <div>
  <Footer></Footer>
 </div>
  </div>
  )
}
