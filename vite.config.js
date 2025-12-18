import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import viteCompression from 'vite-plugin-compression'

export default defineConfig({
    css: {
        preprocessorOptions: {
            scss: {
                api: 'modern-compiler',
            },
        },
    },
    plugins: [
        laravel([]),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        viteCompression(),
    ],
    resolve: {
        alias: {
            '@': '/resources/js',
            '@cmp': '/resources/js/components',
            '@sass': '/resources/sass',
            'vue': 'vue/dist/vue.esm-bundler.js',
        }
    },
})