<script setup>
import IconifyIcon from "~/components/IconifyIcon.vue";
import LoadingSpinner from "~/components/LoadingSpinner.vue";
import ToastMessage from "~/components/ToastMessage.vue";
import ToogleTheme from "~/components/ToogleTheme.vue";
import ApiService from "~/utils/api.js";
</script>

<template>
  <main class="container">
    <div class="mx-auto col-12 col-md-7">
      <div class="text-end p-2">
        <ToogleTheme />
      </div>
      <form class="rounded-3 border overflow-hidden bg-body" @submit.prevent="addTarea()">
        <div class="border-bottom p-3 d-flex gap-2">
          <h3 class="m-0">Lista de Tareas</h3>
          <LoadingSpinner v-if="loading" />
        </div>
        <div class="p-3 d-flex gap-2">
          <input v-model.trim="nuevaTarea.nombre" class="form-control" type="text" placeholder="Crear contenido del blog" autocomplete="off" required>
          <button class="btn btn-primary d-flex align-items-center gap-1" type="submit">
            <IconifyIcon icon="ic:round-add" size="24" />
            Agregar
          </button>
        </div>
        <ul class="tareas px-3">
          <li v-for="(tarea, i) in tareas" :key="tarea.id" class="d-flex gap-2 align-items-center py-2 text-dark-emphasis" :class="{'border-bottom': i < tareas.length - 1}">
            <input v-if="edit === tarea.id" v-model.trim="tarea.nombre" class="form-control flex-fill fw-medium" type="text">
            <span v-else class="flex-fill fw-medium" :class="{'text-decoration-line-through fst-italic text-muted': tarea.completado}">
              {{ tarea.nombre }}
            </span>
            <button class="btn btn-danger tarea-button" type="button" @click="deleteTarea(tarea.id)">
              <IconifyIcon icon="ic:round-close" />
            </button>
            <button class="btn btn-primary tarea-button" type="button" @click="modificarTarea(tarea)">
              <IconifyIcon v-if="edit === tarea.id" icon="ic:round-save" />
              <IconifyIcon v-else icon="ic:outline-edit" />
            </button>
            <button class="btn btn-success tarea-button" type="button" @click="completeTarea(tarea)">
              <IconifyIcon v-if="tarea.completado" icon="ic:baseline-minus" />
              <IconifyIcon v-else icon="bi:check-lg" />
            </button>
          </li>
        </ul>
      </form>
    </div>
    <ToastMessage v-if="!loading && toast.text" :text="toast.text" :success="toast.success" />
  </main>
</template>

<script>
export default {
  props: {
    tareas: {
      type: Array,
      default: () => []
    }
  },
  data () {
    return {
      nuevaTarea: {
        nombre: ""
      },
      loading: false,
      edit: null,
      toast: {
        text: "",
        success: false
      }
    };
  },
  methods: {
    /**
     * Agregar tarea: se ejecuta al enviar el formulario
     * @method
     * @async
     */
    async addTarea () {
      this.loading = true;
      const tarea = await ApiService.addTarea(this.nuevaTarea);
      this.loading = false;
      this.toast.success = Boolean(tarea.id);
      if (!this.toast.success) {
        this.toast.text = "Ha ocurrido un error al crear la tarea";
        return;
      }
      this.toast.text = `Tarea "${tarea.nombre}" creada`;
      this.nuevaTarea.nombre = "";
      this.tareas.push(tarea);
    },
    /**
     * Eliminar tarea: se ejecuta al hacer click en el botón de eliminar
     * @method
     * @async
     * @param {Number} id
     */
    async deleteTarea (id) {
      this.loading = true;
      const tarea = await ApiService.deleteTarea(id);
      this.loading = false;
      this.toast.success = Boolean(tarea.id);
      if (!this.toast.success) {
        this.toast.text = "Ha ocurrido un error al eliminar la tarea";
        return;
      }
      this.toast.text = `Tarea "${tarea.nombre}" eliminada`;
      this.tareas.find((t, i) => {
        if (t.id !== tarea.id) return false;
        this.tareas.splice(i, 1);
        return true;
      });
    },
    /**
     * Marcar como completada o no completada: se ejecuta al hacer click en el botón de completar
     * @method
     * @async
     * @param {Object} tarea
     */
    async completeTarea (tarea) {
      tarea.completado = !tarea.completado;
      this.loading = true;
      const res = await ApiService.completeTarea(tarea.id, tarea.completado);
      this.loading = false;
      this.toast.success = "completado" in res;
      if (!this.toast.success) {
        this.toast.text = "Ha ocurrido un error al modificar la tarea";
        return;
      }
      this.toast.text = `Tarea "${tarea.nombre}" marcada como ${tarea.completado ? "completada" : "no completada"}`;
    },
    /**
     * Modificar tarea: habilita el input para modificar el nombre de la tarea y si se vuelve a hacer click, se guardan los cambios
     * @method
     * @async
     * @param {Object} tarea
     */
    async modificarTarea (tarea) {
      if (!this.edit) {
        this.edit = tarea.id;
        return;
      }
      this.loading = true;
      const res = await ApiService.modificarTarea(tarea.id, tarea);
      this.loading = false;
      this.toast.success = Boolean(res.id);
      if (!this.toast.success) {
        this.toast.text = "Ha ocurrido un error al eliminar la tarea";
        return;
      }
      this.toast.text = `Tarea "${tarea.nombre}" ha sido modificada`;
      this.edit = null;
    }
  }
};
</script>
