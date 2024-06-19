import { createAsyncThunk, createSlice } from "@reduxjs/toolkit";
import { api } from "../Services/api.ts";
import { RootState } from "./store";
import clearAllCookies from "../components/Cookies/cookies.tsx";
import clearAllData from "../components/Cookies/prueba.tsx";

interface IUser {
    id: number;
    name: string;
    inss: string;
}

type AuthState = {
    token: string | null;
    user: IUser | null;
    isLogin: boolean;
    isLoading: boolean;
    error: string | null;
};

const initialState: AuthState = {
    token: null,
    user: null,
    isLogin: false,
    isLoading: false,
    error: null,
};

// Acción para limpiar los datos de autenticación
export const clearAuthData = () => {
    localStorage.removeItem('token');
    localStorage.removeItem('id_user');
    localStorage.removeItem('nombres');
    // Limpiar localStorage
    localStorage.clear();

    // Limpiar sessionStorage
    sessionStorage.clear();

    // Limpiar cookies
    document.cookie.split(";").forEach(function(c) {
        document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/");
    });
};

export const loginUser = createAsyncThunk<{ token: string; user: IUser }, any, { rejectValue: string }>(
    'auth/loginUser',
    async (data: any, { rejectWithValue }) => {
        try {
            // Utiliza await para esperar la respuesta de la promesa
            const response = await api.post('login_news', data);
            const datos = response.data;

            // Ahora intenta acceder al statusCode
            const statusCode = response.statusCode;
            if (statusCode === 200) {
                const { token, id_user, nombres } = datos[0]; // Accede al primer elemento del arreglo de datos
                localStorage.setItem('token', token);
                localStorage.setItem('id_user', id_user.toString());
                localStorage.setItem('nombres', nombres);
                return { token, id_user, nombres };
            }
            throw new Error('Error en la solicitud de inicio de sesión');
        } catch (error) {
            return rejectWithValue(error.message || 'Error en la solicitud de inicio de sesión');
        }
    }
);

export  const onLogout = createAsyncThunk(
    'auth/logout',
    async (_, { rejectWithValue }) => {
        try {
            const token = localStorage.getItem('token');
            const response = await api.post('logout', {}, token);
            const statusCode = response.statusCode;
            if (statusCode === 200) {
                clearAllCookies();
                clearAuthData();
                clearAllData();
                return; // No hay necesidad de devolver ningún valor en este caso
            }
            throw new Error('Error al cerrar sesión');
        } catch (error) {
            return rejectWithValue(error.message || 'Error al cerrar sesión');
        }
    }
);

export const registerUser = createAsyncThunk<{ token: string; user: IUser }, any, { rejectValue: string }>(
    'auth/registerUser',
    async (data: any, { rejectWithValue, getState }) => {
        try {
            const token = (getState() as RootState).auth.token;
            const response = await api.post('register', data, token);
            if (response.ok) {
                const { token, user } = await response.json();
                localStorage.setItem('token', token);
                return { token, user };
            }
            throw new Error('Error en la solicitud de registro de usuario');
        } catch (error) {
            return rejectWithValue(error.message || 'Error en la solicitud de registro de usuario');
        }
    }
);

const authSlice = createSlice({
    name: 'auth',
    initialState,
    reducers: {},
    extraReducers: (builder) => {
        builder
            .addCase(loginUser.pending, (state) => {
                state.isLoading = true;
                state.error = null;
            })
            .addCase(loginUser.fulfilled, (state, action) => {
                state.isLoading = false;
                state.isLogin = true;
                state.token = action.payload.token;
                state.user = action.payload.user;
            })
            .addCase(loginUser.rejected, (state, action) => {
                state.isLoading = false;
                state.token = null;
                state.user = null;
                state.error = action.payload as string;
            })
            .addCase(registerUser.pending, (state) => {
                state.isLoading = true;
                state.error = null;
            })
            .addCase(registerUser.fulfilled, (state, action) => {
                state.isLoading = false;
                state.isLogin = true;
                state.token = action.payload.token;
                state.user = action.payload.user;
            })
            .addCase(registerUser.rejected, (state, action) => {
                state.isLoading = false;
                state.token = null;
                state.user = null;
                state.error = action.payload as string;
            }) // Agregar caso para cambiar el estado de loginUser.pending al cerrar sesión
            .addCase(onLogout.pending, (state) => {
                state.isLoading = true; // Cambia loginUser.pending a true al iniciar el cierre de sesión
            })
            .addCase(onLogout.fulfilled, (state) => {
                state.isLoading = false; // Cambia loginUser.pending a false cuando el cierre de sesión se completa con éxito
                state.token = null;
                state.user =null;
                state.isLogin = false;
            })
            .addCase(onLogout.rejected, (state) => {
                state.isLoading = false; // Cambia loginUser.pending a false si hay un error en el cierre de sesión
            });;
    },
});

export default authSlice.reducer;
