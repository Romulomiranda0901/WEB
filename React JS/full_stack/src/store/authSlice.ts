import {createAsyncThunk, createSlice} from "@reduxjs/toolkit";
import {api} from "../Services/api.ts";

interface IUser {
    id: number,
    name: string,
    email:string,

}

type AuthState= {
    token: string| null;
    user: null  | IUser;
    isLogin: boolean;
    isLoading:boolean;

}

const initialState : AuthState = {
    token: null,
    user: null,
    isLogin: false,
    isLoading:false,
}

export const loginUser = createAsyncThunk('auth/login', async (data: any) => {
    try {

        console.log(data);

        const response = await api.post('auth/loginUser', data);

        if (response.status === 200) {
            return response.data;
        }

        throw new Error('Error en la solicitud de inicio de sesión');
    } catch (error) {
        throw new Error('Error en la solicitud de inicio de sesión');
    }
});



export const registerUser = createAsyncThunk('auth/registerUser', async (data: any) => {
    try {

        console.log(data);

        const response = await api.post('auth/login', data);

        if (response.status === 200) {
            return response.data;
        }

        throw new Error('Error en la solicitud de inicio de sesión');
    } catch (error) {
        throw new Error('Error en la solicitud de inicio de sesión');
    }
});

 const authSlice = createSlice({
    name: 'autth',
    initialState: initialState,
    extraReducers : (builder:any)=> {
        builder.addCase(loginUser.pending,(state:AuthState,acction: any)=>{
            state.isLoading = true;

        }).addCase(loginUser.fulfilled,(state:AuthState,acction: any)=>{
            state.isLoading = false;
            state.isLoading = true;
            state.token = acction.payload.token;
            state.user = acction.payload.user;
        }).addCase(loginUser.rejected,(state:AuthState,acction: any)=>{
            state.isLoading = false;
            state.isLoading = false;
            state.token = null;
            state.user = null;
            }).addCase(registerUser.pending,(state:AuthState,acction: any)=>{
            state.isLoading = true;

        }).addCase(registerUser.fulfilled,(state:AuthState,acction: any)=>{
            state.isLoading = false;
            state.isLoading = true;
            state.token = acction.payload.token;
            state.user = acction.payload.user;
        }).addCase(registerUser.rejected,(state:AuthState,acction: any)=>{
            state.isLoading = false;
            state.isLoading = false;
            state.token = null;
            state.user = null;
        });

    },


})

export default authSlice.reducer;