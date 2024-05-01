// src/actions/taskActions.ts

// Definición de tipos
export const ADD_TASK = 'ADD_TASK';

// Acción para agregar una nueva tarea
export const addTask = (task: { id: number; description: string }) => {
    return {
        type: ADD_TASK,
        payload: task,
    };
};
