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
                
                'name' => 'Início',
                'type' => 'internal_link',
                'link' => '/',
                'icon' => 'las la-home',
                'parent_id' => null,
            ]);

            MenuItem::create([
                
                'name' => 'Notícias',
                'type' => 'internal_link',
                'link' => 'noticias',
                'icon' => 'las la-newspaper',
                'parent_id' => null,
            ]);

            MenuItem::create([
                
                'name' => 'Calendário',
                'type' => 'internal_link',
                'link' => 'calendario',
                'icon' => 'las la-calendar',
                'parent_id' => null,
            ]);

            MenuItem::create([
                
                'name' => 'Tarefas',
                'type' => 'internal_link',
                'link' => 'tarefas',
                'icon' => 'las la-tasks',
                'parent_id' => null,
            ]);

            $docs = MenuItem::create([
                
                'name' => 'Documentos',
                'type' => 'internal_link',
                'link' => '#',
                'icon' => 'las la-folder',
                'parent_id' => null,
            ]);

            MenuItem::create([
                
                'name' => 'Políticas',
                'type' => 'internal_link',
                'icon' => 'las la-file-alt',
                'link' => 'documentos',
                'parent_id' => $docs->id,
            ]);

            MenuItem::create([
                
                'name' => 'Manuais',
                'type' => 'internal_link',
                'icon' => 'las la-book',
                'link' => '#',
                'parent_id' => $docs->id,
            ]);

            MenuItem::create([
                
                'name' => 'Ouvidoria',
                'type' => 'internal_link',
                'icon' => 'las la-comments',
                'link' => 'ouvidoria',
                'parent_id' => null,
            ]);

            // Last Access
            MenuItem::create([
                
                'name' => 'Portal RH',
                'type' => 'internal_link',
                'link' => '#',
                'icon' => 'las la-users',
                'parent_id' => null,
                'menu_key' => 'fastaccess',
            ]);

            MenuItem::create([
                
                'name' => 'Suporte TI',
                'type' => 'internal_link',
                'link' => '#',
                'icon' => 'las la-headset',
                'parent_id' => null,
                'menu_key' => 'fastaccess',
            ]);

            // Links
            MenuItem::create([
                
                'name' => 'Google',
                'type' => 'external_link',
                'link' => 'https://google.com',
                'icon' => 'lab la-google',
                'parent_id' => null,
                'menu_key' => 'links',
            ]);

            MenuItem::create([
                
                'name' => 'LinkedIn',
                'type' => 'external_link',
                'link' => 'https://linkedin.com',
                'icon' => 'lab la-linkedin',
                'parent_id' => null,
                'menu_key' => 'links',
            ]);
    }
}
