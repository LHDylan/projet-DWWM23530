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
                'resources/css/bleu-admin.css',
                'resources/css/bleu-admin.min.css',
                'resources/js/bleu-admin.js',
                'resources/css/bleu.css',
                'resources/js/bleu.js',
                'resources/css/vert.css',
                'resources/css/vertAdmin.css',
                'resources/css/rougeStyleTableauDeBord.css',
                'resources/css/rougeStyleVueActualite.css',
                'resources/css/rougeStyleVueActualiteCrud.css',
                'resources/css/rougeStyleVueActualiteFront.css',
            ],
            refresh: true,
        }),
    ],
});
