import {Outlet} from "react-router-dom";
import Header from "../../components/Header/Header.jsx";
import Sidebar from "../../components/Sidebar/Sidebar.jsx";
// Icons
import { RiLineChartLine, RiHashtag } from "react-icons/ri";

function BaseDashBoard() {
    return (
        <div>
            <div className="grid lg:grid-cols-4 xl:grid-cols-6 min-h-screen">
                <Sidebar/>
                <main className="lg:col-span-3 xl:col-span-5 bg-gray-100 p-8 h-[100vh] overflow-y-scroll">
                    <Header/>

                </main>
            </div>
            <Outlet/>
        </div>
    );
}

export default BaseDashBoard;