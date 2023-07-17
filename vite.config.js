import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path'

export default defineConfig({
    server: {
        host: '0.0.0.0',
        server: '5174',
        hmr: {
            host: 'localhost'
        }
    },
    preview: {
        port: '4173'
    },
    plugins: [
        laravel({
            input: ['resources/sass/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '~datatables.net-bs4': path.resolve(__dirname, 'node_modules/datatables.net-bs4')
        }
    }
});
