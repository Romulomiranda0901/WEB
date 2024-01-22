import { createApp, h } from "vue";
import "bootstrap/dist/css/bootstrap.min.css";
import "./../css/theme-light.css";
import "./../css/theme-dark.css";
import "./../css/app.css";
import "./../css/buttons.css";
import { createInertiaApp } from "@inertiajs/vue3";
import MainLayout from "@/layouts/MainLayout.vue";

createInertiaApp({
  resolve: async (name) => {
    const pages = import.meta.glob("./pages/**/*.vue");
    const page = await pages[`./pages/${name}.vue`]();
    page.default.layout = page.default.layout || MainLayout;
    return page;
  },
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props) });
    app.use(plugin);
    app.mount(el);
  },
});
