<script setup>
import { Icon } from "@iconify/vue";
</script>

<template>
  <Icon :icon="icon" :width="size" :height="size" />
</template>

<script>
export default {
  props: {
    icon: {
      type: String,
      required: true
    },
    size: {
      type: String,
      default: "1em"
    }
  }
};
</script>
