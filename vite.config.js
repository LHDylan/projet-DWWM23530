import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/404.css',
                'resources/js/404.js',
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/vert.css',
                'resources/css/rougeStyleTableauDeBord.css',
                'resources/css/rougeStyleVueActualite.css',
                'resources/css/rougeStyleVueActualiteCrud.css',
                'resources/css/rougeStyleVueActualiteFront.css',
            ],
            refresh: true,
        }),
    ],
});
