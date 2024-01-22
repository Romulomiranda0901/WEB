import { ofetch } from "ofetch";

class ApiService {

  async getTareas () {
    return await ofetch("/api/tareas", {
      method: "GET"
    }).catch(() => []);
  }

  async addTarea (tarea) {
    return await ofetch("/api/tareas", {
      method: "POST",
      body: { tarea }
    }).catch(() => ({}));
  }

  async deleteTarea (id) {
    return await ofetch(`/api/tareas/${id}`, {
      method: "DELETE"
    }).catch(() => ({}));
  }

  async completeTarea (id, value) {
    return await ofetch(`/api/tareas/${id}`, {
      method: "PATCH",
      body: { completado: value }
    }).catch(() => ({}));
  }

  async modificarTarea (id, tarea) {
    return await ofetch(`/api/tareas/${id}`, {
      method: "PUT",
      body: { tarea }
    }).catch(() => ({}));
  }
}

export default new ApiService();
