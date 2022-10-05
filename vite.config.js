import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
const path = require('path')
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/scss/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        extensions: ['.js', '.vue'],
        alias: {
            "@": path.resolve(__dirname, "./resources/js"),
            "styles@": path.resolve(__dirname, "./resources/scss"),
        },
    },
});
