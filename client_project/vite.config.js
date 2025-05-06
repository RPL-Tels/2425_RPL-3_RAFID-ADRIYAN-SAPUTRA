import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    imports: {
            "three": "https://cdn.jsdelivr.net/npm/three@<version>/build/three.module.js",
            "three/addons/": "https://cdn.jsdelivr.net/npm/three@<version>/examples/jsm/"
    },
});
