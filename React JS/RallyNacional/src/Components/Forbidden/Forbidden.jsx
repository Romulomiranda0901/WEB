import React, { useState, useEffect } from 'react';
import './css/forbidden.css';

const Forbidden =() =>
{
  return(
      <div>
          <div className='contenido' >
              <div className="message">No está autorizado.
              </div>
              <div className="message2">Intentó acceder a una página para la que no tenía autorización previa.</div>
              <div className="container1">
                  <div className="neon">403</div>
                  <div className="door-frame">
                      <div className="door">
                          <div className="rectangle">
                          </div>
                          <div className="handle">
                          </div>
                          <div className="window">
                              <div className="eye">
                              </div>
                              <div className="eye eye2">
                              </div>
                              <div className="leaf">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

  )
}
 export default Forbidden


