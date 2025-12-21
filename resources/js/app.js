import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'

//import ApexCharts from 'vue3-apexcharts'

import { EventEmitter } from 'events'
import axios from 'axios'

import GuestLayout from './Layouts/GuestLayout.vue'

EventEmitter.defaultMaxListeners = 1000

window.EventBus = new EventEmitter()

window.csrf_token = document.head.querySelector('meta[name="csrf-token"]').content

window.axios = axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrf_token

createInertiaApp({
    title: (title) => `${title} - ERP`,

    resolve: async (name) => {
        let page = await resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        )

        if (typeof page.default.layout === 'undefined') {
            if (name.startsWith('Guest/')) {
                page.default.layout = GuestLayout
            } else {
                page.default.layout = AppLayout
            }
        }

        return page
    },

    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .provide('csrf_token', csrf_token)
            //.use(ApexCharts)
            .mount(el)
    },

    progress: {
        color: '#4f46e5', 
        showSpinner: true,
    },
})