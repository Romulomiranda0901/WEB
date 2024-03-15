import {combineReducers, configureStore,getDefaultMiddleware, AnyAction} from "@reduxjs/toolkit";
import {thunk, ThunkDispatch} from "redux-thunk";
import {useDispatch} from "react-redux";
import {persistReducer, persistStore} from 'redux-persist';
import storage from "redux-persist/lib/storage"
import authSlice from "./authSlice.ts";
const persistConfig = {
    key:"root",
    storage,
}
const reducers = combineReducers({
    auth: authSlice,
})
const persistedReducer = persistReducer(persistConfig,reducers)
export const store = configureStore({
    reducer: persistedReducer, // Aquí debes proporcionar tus reducers
    middleware: (getDefaultMiddleware) => getDefaultMiddleware().concat(thunk),
});


export const persitor = persistStore(store);

export type RootState = ReturnType<typeof store.getState>;

export type AppDispatch = typeof store.dispatch;

export type AppThunkDispatch = ThunkDispatch<RootState,void,AnyAction>
export const useAppDispatch = ()=> useDispatch<AppDispatch>();