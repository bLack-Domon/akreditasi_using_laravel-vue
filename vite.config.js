import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                // css
                'resources/assets/plugins/fontawesome-free/css/all.min.css',
                'resources/assets/dist/css/adminlte.min.css',
                // js
                'resources/assets/plugins/jquery/jquery.min.js',
                'resources/assets/plugins/bootstrap/js/bootstrap.bundle.min.js',
                'resources/assets/dist/js/adminlte.min.js',
                'https://code.jquery.com/jquery-3.7.0.js',
                'https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js',
                'https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js',
                'resources/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js'
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            }
        }),
    ],
});
