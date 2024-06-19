import { combineReducers, configureStore, getDefaultMiddleware } from "@reduxjs/toolkit";
import {thunk,  ThunkDispatch } from "redux-thunk";
import { useDispatch } from "react-redux";
import { persistReducer, persistStore } from 'redux-persist';
import storage from "redux-persist/lib/storage";
import authSlice from "./authSlice.ts";

const persistConfig = {
    key: "root",
    storage,
};

const rootReducer = combineReducers({
    auth: authSlice,
});

const persistedReducer = persistReducer(persistConfig, rootReducer);

// Utilizamos getDefaultMiddleware directamente
export const store = configureStore({
    reducer: persistedReducer,
    middleware: (getDefaultMiddleware) => getDefaultMiddleware().concat(thunk),
});

export const persitor = persistStore(store);

export type RootState = ReturnType<typeof store.getState>;

// Simplificamos el tipo de despacho de acciones para utilizar solo Dispatch de Redux Toolkit
export type AppDispatch = typeof store.dispatch;

// También definimos un tipo para el despacho de acciones asíncronas
export type AppThunkDispatch = ThunkDispatch<RootState, void, any>;

// Eliminamos la función useAppDispatch personalizada y usamos useDispatch directamente
export const useAppDispatch = () => useDispatch<AppDispatch>();