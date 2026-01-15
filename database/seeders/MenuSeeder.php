<?php

namespace Database\Seeders;

use Backpack\MenuCRUD\app\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing menu items to avoid duplicates if run multiple times
        MenuItem::truncate();

        // Menu Items
            MenuItem::create([
                'tenant_id' => 0,
                'name' => 'Início',
                'type' => 'internal_link',
                'link' => '/',
                'icon' => 'las la-home',
                'parent_id' => null,
            ]);

            MenuItem::create([
                'tenant_id' => 0,
                'name' => 'Notícias',
                'type' => 'internal_link',
                'link' => 'noticias',
                'icon' => 'las la-newspaper',
                'parent_id' => null,
            ]);

            MenuItem::create([
                'tenant_id' => 0,
                'name' => 'Calendário',
                'type' => 'internal_link',
                'link' => 'calendario',
                'icon' => 'las la-calendar',
                'parent_id' => null,
            ]);

            MenuItem::create([
                'tenant_id' => 0,
                'name' => 'Tarefas',
                'type' => 'internal_link',
                'link' => 'tarefas',
                'icon' => 'las la-tasks',
                'parent_id' => null,
            ]);

            $docs = MenuItem::create([
                'tenant_id' => 0,
                'name' => 'Documentos',
                'type' => 'internal_link',
                'link' => '#',
                'icon' => 'las la-folder',
                'parent_id' => null,
            ]);

            MenuItem::create([
                'tenant_id' => 0,
                'name' => 'Políticas',
                'type' => 'internal_link',
                'icon' => 'las la-file-alt',
                'link' => 'documentos',
                'parent_id' => $docs->id,
            ]);

            MenuItem::create([
                'tenant_id' => 0,
                'name' => 'Manuais',
                'type' => 'internal_link',
                'icon' => 'las la-book',
                'link' => '#',
                'parent_id' => $docs->id,
            ]);

            MenuItem::create([
                'tenant_id' => 0,
                'name' => 'Ouvidoria',
                'type' => 'internal_link',
                'icon' => 'las la-comments',
                'link' => 'ouvidoria',
                'parent_id' => null,
            ]);

            // Last Access
            MenuItem::create([
                'tenant_id' => 0,
                'name' => 'Portal RH',
                'type' => 'internal_link',
                'link' => '#',
                'icon' => 'las la-users',
                'parent_id' => null,
                'menu_key' => 'fastaccess',
            ]);

            MenuItem::create([
                'tenant_id' => 0,
                'name' => 'Suporte TI',
                'type' => 'internal_link',
                'link' => '#',
                'icon' => 'las la-headset',
                'parent_id' => null,
                'menu_key' => 'fastaccess',
            ]);

            // Links
            MenuItem::create([
                'tenant_id' => 0,
                'name' => 'Google',
                'type' => 'external_link',
                'link' => 'https://google.com',
                'icon' => 'lab la-google',
                'parent_id' => null,
                'menu_key' => 'links',
            ]);

            MenuItem::create([
                'tenant_id' => 0,
                'name' => 'LinkedIn',
                'type' => 'external_link',
                'link' => 'https://linkedin.com',
                'icon' => 'lab la-linkedin',
                'parent_id' => null,
                'menu_key' => 'links',
            ]);
    }
}
