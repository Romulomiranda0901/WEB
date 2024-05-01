export function agregarSubmenusAMenus(menus, submenus, submenuHijos) {
    const menusDict = {};

    menus.forEach(menu => {
        menusDict[menu.id_menu] = menu;
        menu.submenus = [];
    });

    submenus.forEach(submenu => {
        const menuPadre = menusDict[submenu.id_menu];
        if (menuPadre) {
            menuPadre.submenus.push(submenu);
        }
    });

    submenuHijos.forEach(submenuHijo => {
        const menuPadre = menusDict[submenuHijo.id_submenu];
        if (menuPadre) {
            if (!menuPadre.submenus) {
                menuPadre.submenus = [];
            }
            menuPadre.submenus.push(submenuHijo);
        }
    });

    return menus;
}
