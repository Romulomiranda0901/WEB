
import Cookies from 'universal-cookie';

const clearAllData = () => {
    // Limpiar localStorage
    localStorage.clear();

    // Limpiar cookies
    const cookies = new Cookies();
    cookies.remove('cookie_name');

};

export default clearAllData;