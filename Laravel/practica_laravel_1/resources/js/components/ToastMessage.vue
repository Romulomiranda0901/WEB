<script setup>
import IconifyIcon from "./IconifyIcon.vue";
import { showToast } from "~/utils/bootstrap.js";
</script>

<template>
  <div class="toast-container position-fixed bottom-0 start-0 p-3">
    <div ref="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-body">
        <div class="d-flex align-items-center gap-2">
          <IconifyIcon v-if="success" icon="solar:check-circle-bold" size="1.5em" class="text-success flex-shrink-0" />
          <IconifyIcon v-else icon="solar:close-circle-bold" size="1.5em" class="text-danger flex-shrink-0" />
          <span class="text-dark-emphasis fw-medium">{{ text }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    text: {
      type: String,
      default: ""
    },
    success: {
      type: Boolean,
      default: false
    }
  },
  emits: ["dispose"],
  data () {
    return {
      show: true
    };
  },
  mounted () {
    const toast = showToast(this.$refs.toast);
    toast.addEventListener("hidden.bs.toast", () => {
      this.$emit("dispose");
    });
  }
};
</script>
