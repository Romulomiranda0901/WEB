<script setup>
defineProps({
  about: String
})
</script>

<template>
  <main class="h-100 w-100">
    <div class="container">
      <h1>Lista de Tareas</h1>
      <p>Lista de tareas utilizando Laravel, Inertia, base de datos MySQL y Vue.</p>
      <h4>Tecnologías</h4>
      <ul>
        <li>Backend:</li>
        <ul>
          <li>Laravel (PHP Framework)</li>
          <li>Composer</li>
          <li>MySQL</li>
          <li>Node.js</li>
          <li>Vite</li>
          <li>Inertia</li>
        </ul> 
        <li>Frontend:</li>
        <ul>
          <li>Vue 3</li>
          <li>Bootstrap 5</li>
        </ul>
      </ul>
    </div>
  </main>
</template>
