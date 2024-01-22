<script setup>
import IconifyIcon from "./IconifyIcon.vue";
</script>

<template>
  <span class="text-dark-emphasis" role="button" @click="toogleTheme()">
    <IconifyIcon v-if="!dark" icon="ic:outline-wb-sunny" size="18" />
    <IconifyIcon v-else icon="ic:outline-nights-stay" size="18" />
  </span>
</template>

<script>
export default {
  data () {
    return {
      dark: JSON.parse(localStorage.getItem("dark"))
    };
  },
  methods: {
    /**
     * Cambiar tema de la aplicación
     * @method
     */
    toogleTheme () {
      this.dark = !this.dark;
      localStorage.setItem("dark", this.dark);
      document.body.setAttribute("data-bs-theme", this.dark ? "dark" : "light");
    }
  },
};
</script>
