import axios from "axios";


export const fetchData = async (url, setState, options = {}, _loading = null) => {

    let status = null;
    let response = null;
    let data = null;

    try {

        //  const token = sessionStorage.getItem('auth_token');

        /*   const headers = {
              "Authorization": `Bearer ${token}`
         };*/

        // options["headers"] = { ...headers, ...options.headers }
        response = await axios.request({
            url: `${process.env.REACT_APP_API_URL}/api/${url}`,
            ...options
        });

        ({data, status} = response);
        setState((value) => !value);

    } catch (error) {
        response = error.response;
        ({status} = error.response);

        if (status == 403) {
            window.location.href = "/forbidden";
        }

        throw error;

    } finally {
        return {
            data,
            status,
            response
        }
    }
}

export const fetchList = async (url, setRows, _loading) => {
    const {data} = await fetchData(`${url}/listar`, {}, _loading);
    setRows(data);
}

export const fetchList2 = async (url, setRows, _loading) => {
    const {data} = await fetchData(`${url}`, {}, _loading);
    setRows(data);
}

export const fetchDataDepend = async (base, depend, value, setRows) => {
    if (!value) return;

    const id = value;

    const {data} = await fetchData(`${base}/${id}/${depend}`);
    setRows(data);

}

export const fetchDelete = async (url, setState, options, value) => {

    if (!value) return;
    const {id} = value;

    const {data} = await fetchData(`${url}/eliminar/${id}`, setState, {
        method: "DELETE",
        ...options

    },);
    setState((value) => !value);
    return {data};
}

