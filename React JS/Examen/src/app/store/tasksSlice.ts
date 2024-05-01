import { createSlice, PayloadAction } from '@reduxjs/toolkit';

// Define la interfaz para el estado de las tareas
export interface TasksState {
    counter: {
        value: number;
    };
}

// Define el estado inicial para las tareas
const initialState: TasksState = {
    counter: {
        value: 0,
    },
};

// Crea el slice de Redux para las tareas
const tasksSlice = createSlice({
    name: 'tasks', // Nombre del slice
    initialState, // Estado inicial
    reducers: {
        // Define las acciones para incrementar y decrementar el contador
        increment(state) {
            state.counter.value += 1;
        },
        decrement(state) {
            state.counter.value -= 1;
        },
        setCounterValue(state, action: PayloadAction<number>) {
            state.counter.value = action.payload;
        },
    },
});

// Exporta las acciones generadas automáticamente (increment, decrement)
export const { increment, decrement, setCounterValue } = tasksSlice.actions;

// Exporta el reducer generado automáticamente por createSlice
export default tasksSlice.reducer;
