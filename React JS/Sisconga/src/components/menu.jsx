
import React, {useEffect, useState} from 'react'
import { Navbar, Nav, NavDropdown } from 'react-bootstrap';
import {useRecoilState} from "recoil";
import {usuarioAtom} from "../libs/RecoilState";
import {fetchData} from "../libs/useAxios";
import {agregarSubmenusAMenus} from "../libs/util";
import '../menu.css'


export default function Menu()
{
    const [user, setUser] = useRecoilState(usuarioAtom);
    const [estado, setEstado] = useState(false);
    const [menu, setMenu] = useState([]);
    const token =user.token;
    const id_rol = user.id_rol;

    useEffect(() => {
        (async function (){
            const { data } =  await fetchData("listar_permisos_menu", setEstado,{
                headers:{"Authorization": `Bearer ${token}`},
                method: "POST",
                data: {id_rol},
            });
            const menu_completo= agregarSubmenusAMenus(data.menus,data.submenus,data.submenus)
             setMenu(menu_completo)
        })();
    }, []);

    console.log(menu);


    return(
        <div>
            <Navbar  expand="lg" variant={"dark"}  className="custom-navbar">
                <Navbar.Brand href="#home">Mi Aplicación</Navbar.Brand>
                <Navbar.Toggle aria-controls="basic-navbar-nav" />
                <Navbar.Collapse id="basic-navbar-nav" className="justify-content-center">
                    <Nav className="mr-auto">
                        {menu.map((menu) =>
                            menu.submenus.length > 0 ? (
                                <NavDropdown  menuVariant={"dark"}
                                    key={menu.id_menu}
                                    title={menu.menu}
                                    id={`submenu-${menu.id_menu}`}
                                >
                                    {menu.submenus.map((submenu) => (
                                        <NavDropdown.Item key={submenu.id_submenu}>
                                            {submenu.nombre_submenu}
                                        </NavDropdown.Item>
                                    ))}
                                </NavDropdown>
                            ) : (
                                <Nav.Link key={menu.id_menu} href={`#${menu.menu}`}>
                                    {menu.menu}
                                </Nav.Link>
                            )
                        )}
                    </Nav>
                </Navbar.Collapse>
            </Navbar>
        </div>


    )
}