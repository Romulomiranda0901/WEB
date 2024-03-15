import {Outlet} from "react-router-dom";

function BaseDashBoard() {
    return (
        <div>
            <h1>dashboard</h1>
            <Outlet/>
        </div>
    );
}

export default BaseDashBoard;