<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
  <div class="vh-100 d-flex flex-column">
    <div class="flex-fill d-flex align-items-center">
      <slot />
    </div>
    <footer class="py-3">
      <ul class="nav justify-content-center border-top">
        <li class="nav-item">
          <Link class="nav-link px-2" href="/">Inicio</Link>
        </li>
        <li class="nav-item">
          <Link class="nav-link px-2" href="/about">Sobre</Link>
        </li>
        <li class="nav-item">
          <a class="nav-link px-2" href="https://github.com/Yizack/prueba-intermedio-tareas" target="_blank">Github</a>
        </li>
      </ul>
    </footer>
  </div>
</template>

<script>
export default {
  data () {
    return {
      dark: JSON.parse(localStorage.getItem("dark"))
    };
  },
  mounted () {
    document.body.setAttribute("data-bs-theme", this.dark ? "dark" : "light");
  },
};
</script>
