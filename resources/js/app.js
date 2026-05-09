import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .mixin({ methods: { route } });

        // Determine layout: if page exports a layout, use it; else check if it's a frontend page; else use DefaultLayout
        let LayoutComponent = DefaultLayout;
        if (App.layout) {
            LayoutComponent = App.layout;
        } else if (App.frontendLayout) {
            LayoutComponent = FrontendLayout;
        } else {
            // Heuristic: if the page is in Frontend folder, use FrontendLayout
            if (name && name.startsWith('Frontend/')) {
                LayoutComponent = FrontendLayout;
            }
        }

        app.component('Layout', LayoutComponent);
        app.mount(el);
    },
});
