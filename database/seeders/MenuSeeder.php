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

        // Main Items
        MenuItem::create([
            'name' => 'Início',
            'type' => 'internal_link',
            'link' => '/',
            'icon' => 'fas fa-home',
            'parent_id' => null,
            'lft' => 1,
            'rgt' => 2,
            'depth' => 1,
        ]);

        MenuItem::create([
            'name' => 'Notícias',
            'type' => 'internal_link',
            'link' => 'noticias',
            'icon' => 'fas fa-newspaper',
            'parent_id' => null,
            'lft' => 3,
            'rgt' => 4,
            'depth' => 1,
        ]);

        MenuItem::create([
            'name' => 'Calendário',
            'type' => 'internal_link',
            'link' => 'calendario',
            'icon' => 'fas fa-calendar',
            'parent_id' => null,
            'lft' => 5,
            'rgt' => 6,
            'depth' => 1,
        ]);

        // Documents Dropdown
        $docs = MenuItem::create([
            'name' => 'Documentos',
            'type' => 'internal_link',
            'link' => '#',
            'icon' => 'fas fa-folder',
            'parent_id' => null,
            'lft' => 7,
            'rgt' => 12, // Will contain children
            'depth' => 1,
        ]);

        MenuItem::create([
            'name' => 'Políticas',
            'type' => 'internal_link',
            'icon' => 'fas fa-file-alt',
            'link' => 'documentos',
            'parent_id' => $docs->id,
            'lft' => 8,
            'rgt' => 9,
            'depth' => 2,
        ]);

        MenuItem::create([
            'name' => 'Manuais',
            'type' => 'internal_link',
            'icon' => 'fas fa-book',
            'link' => '#',
            'parent_id' => $docs->id,
            'lft' => 10,
            'rgt' => 11,
            'depth' => 2,
        ]);

        MenuItem::create([
            'name' => 'Ouvidoria',
            'type' => 'internal_link',
            'icon' => 'fas fa-comments',
            'link' => 'ouvidoria',
            'parent_id' => null,
            'lft' => 13,
            'rgt' => 14,
            'depth' => 1,
        ]);

        MenuItem::create([
            'name' => 'Sobre Nós',
            'type' => 'page_link',
            'page_id' => 1, // Assuming 'About Us' page has ID 1
            'icon' => 'fas fa-info-circle',
            'parent_id' => null,
            'lft' => 15,
            'rgt' => 16,
            'depth' => 1,
        ]);
    }
}
