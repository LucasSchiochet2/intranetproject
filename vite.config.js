import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/app.scss', 'resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: true, // Permite acesso de qualquer host/subdomínio
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
        // origin pode ser ajustado se necessário para refletir o domínio de acesso
        // origin: 'https://teste.intranet.app.br',
    },
});
