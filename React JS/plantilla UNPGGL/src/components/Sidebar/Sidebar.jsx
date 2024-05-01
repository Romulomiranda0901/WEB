import React, { useState } from "react";
// Icons
import {
  RiHome3Line,
  RiMore2Fill,
  RiCloseFill,
  RiUserLine,
  RiMoneyDollarCircleLine,
  RiCustomerService2Line
} from "react-icons/ri";
import { useNavigate } from "react-router-dom";

import {onLogout} from "../../store/authSlice";
import {useAppDispatch} from "../../store/store";

const Sidebar = () => {
  const [showMenu, setShowMenu] = useState(false);

  const dispatch = useAppDispatch();
  const navigate = useNavigate();
  const onSubmit = async () => {
    try {
      await dispatch(onLogout());
      navigate("/");
    } catch (error) {
      console.error("Error al iniciar sesión:", error);
      // Aquí puedes manejar el error, como mostrar un mensaje al usuario
    }
  };

  return (
      <>
        <div
            className={`bg-gradient-to-r from-[#772D2F] to-[#772D2F] fixed lg:static w-[80%] md:w-[40%] lg:w-full transition-all z-50 duration-300 ${
                showMenu ? "left-0" : "-left-full"
            }`}
        >
          {/* Profile */}
          <div className="flex flex-col items-center justify-center p-8 gap-2 h-[30vh]">
            <img
                src="/user_2.png"
                className="w-20 h-20 object-cover rounded-full ring-2 ring-gray-300"
            />
            <h1 className="text-xl text-white font-bold"></h1>
            <p className="bg-gradient-to-r from-[#BB782A] to-white-80 py-2 px-2 rounded-full text-white">
              {localStorage.getItem('nombres')}
            </p>
          </div>
          {/* Nav */}
          <div className="bg-gradient-to-r from-[#BB782A] to-white-80 p-8 rounded-tr-[100px] h-[70vh] overflow-y-scroll flex flex-col justify-between gap-8">
            <nav className="flex flex-col gap-8">
              <button
                  onClick={() => navigate("/")}
                  className="flex items-center gap-4 text-white py-2 px-4 rounded-xl hover:bg-primary-900/50 transition-colors"
              >
                <RiHome3Line /> Home
              </button>
              <button
                  onClick={() => navigate("/dashboard/cliente")}
                  className="flex items-center gap-4 text-white py-2 px-4 rounded-xl hover:bg-primary-900/50 transition-colors"
              >
                <RiCustomerService2Line />Cliente
              </button>
              <button
                  onClick={() => navigate("/dashboard/precio")}
                  className="flex items-center gap-4 text-white py-2 px-4 rounded-xl hover:bg-primary-900/50 transition-colors"
              >
                <RiMoneyDollarCircleLine /> Precios
              </button>
              <button
                  onClick={() => navigate("/")}
                  className="flex items-center gap-4 text-white py-2 px-4 rounded-xl hover:bg-primary-900/50 transition-colors"
              >
                <RiUserLine /> User
              </button>
            </nav>
            <div className="bg-primary-900/50 text-white p-4 rounded-xl">
              <button onClick={onSubmit}>Cerrar sesión</button>
            </div>
          </div>
        </div>
        {/* Button mobile */}
        <button
            onClick={() => setShowMenu(!showMenu)}
            className="lg:hidden fixed right-4 bottom-4 text-2xl bg-primary-900 p-2.5 rounded-full text-white z-50"
        >
          {showMenu ? <RiCloseFill /> : <RiMore2Fill />}
        </button>
      </>
  );
};

export default Sidebar;
