
import ListarRecibo from "../../../components/Tesoreria/Recibos/ListarRecibo";
import {FaSearch,FaRegArrowAltCircleRight  } from "react-icons/fa";
import { Link } from 'react-router-dom';

export default function PageRecibos()
{
    /*Hooks*/

    return (
        <section>
            <div className="row page-header">
                <div className="col-6 p-0">
                    <h4>Tesorería</h4>
                    <h5>Registro de Recibos</h5>
                </div>
                <div className="col-3 p-0 mt-3 conten_fecha">
                    <select class="form-control input-xs" id="anyo">
                        <option value="0" disabled>Seleccione un año</option>
                        <option value="2023" selected>2023</option>

                    </select>
                </div>
                <div className="col-3 mt-3 conten_fecha">
                    <select class="form-control input-xs" id="caja">
                        <option value="0" disabled selected>Central-001.001</option>
                    </select>
                </div>
            </div>

            <hr/>
            <div className="row">
                <div className="col-6 p-0 order-2">
                    <nav className="contenedor_buscador">
                        <div className="search-container">
                            <input
                                type="text"
                                className="form-control input buscador busca"
                                id="txtbuscador"
                                autoComplete="off"
                                placeholder="Buscar por Número de Recibo"
                            />
                            <i className="fa fa-search">
                                <FaSearch/>
                            </i>
                        </div>
                        <i className="fa fa-spinner girar"></i>
                        <ul className="reducir_buscador_listado_principal"></ul>
                    </nav>
                </div>
                <div className="col-6 p-0 order-1" id="btn_nuevo_place">
                    <Link to={'/tesoreria/NuevoRecibo'} className="btn btn-success" id="btn_nuevo">
                        Nuevo <FaRegArrowAltCircleRight/>
                    </Link>
                </div>
            </div>
            <ListarRecibo/>
        </section>

    )
}