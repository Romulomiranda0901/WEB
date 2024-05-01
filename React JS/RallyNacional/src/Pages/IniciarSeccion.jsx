import React, { useState, useEffect } from 'react';
import Login from "../Components/Login/login";
import '../Components/Login/css/index.css'


export default function IniciarSeccion()
{
    /*Hooks*/

    return(
        <div className='contenedor_login'>

            <Login/>

        </div>
    )
}