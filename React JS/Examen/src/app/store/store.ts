import { configureStore, createSlice, PayloadAction } from '@reduxjs/toolkit';

// Define el tipo de datos para una tarea
interface Task {
    id: number;
    description: string;
}

// Define el estado inicial para las tareas
interface TasksState {
    tasks: Task[];
}

// Define el estado inicial
const initialState: TasksState = {
    tasks: [],
};

// Crea el slice de Redux para las tareas
const tasksSlice = createSlice({
    name: 'tasks', // Nombre del slice
    initialState, // Estado inicial
    reducers: {
        addTask(state, action: PayloadAction<Task>) {
            state.tasks.push(action.payload);
        },
    },
});

// Exporta las acciones generadas automáticamente (addTask)
export const { addTask } = tasksSlice.actions;

// Configura y crea la tienda Redux
export const store = configureStore({
    reducer: {
        tasks: tasksSlice.reducer,
    },
});

// Exporta los tipos de utilidad para acceder al estado y despachar acciones
export type RootState = ReturnType<typeof store.getState>;
export type AppDispatch = typeof store.dispatch;
