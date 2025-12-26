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
            'parent_id' => null,
            'lft' => 1,
            'rgt' => 2,
            'depth' => 1,
        ]);

        MenuItem::create([
            'name' => 'Notícias',
            'type' => 'internal_link',
            'link' => 'news',
            'parent_id' => null,
            'lft' => 3,
            'rgt' => 4,
            'depth' => 1,
        ]);

        MenuItem::create([
            'name' => 'Calendário',
            'type' => 'internal_link',
            'link' => 'calendar',
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
            'parent_id' => null,
            'lft' => 7,
            'rgt' => 12, // Will contain children
            'depth' => 1,
        ]);

        MenuItem::create([
            'name' => 'Políticas',
            'type' => 'internal_link',
            'link' => 'documents/policies',
            'parent_id' => $docs->id,
            'lft' => 8,
            'rgt' => 9,
            'depth' => 2,
        ]);

        MenuItem::create([
            'name' => 'Manuais',
            'type' => 'internal_link',
            'link' => 'documents/manuals',
            'parent_id' => $docs->id,
            'lft' => 10,
            'rgt' => 11,
            'depth' => 2,
        ]);

        MenuItem::create([
            'name' => 'Ouvidoria',
            'type' => 'internal_link',
            'link' => 'ombudsman',
            'parent_id' => null,
            'lft' => 13,
            'rgt' => 14,
            'depth' => 1,
        ]);
        
        MenuItem::create([
            'name' => 'Sobre Nós',
            'type' => 'page_link',
            'page_id' => 1, // Assuming 'About Us' page has ID 1
            'parent_id' => null,
            'lft' => 15,
            'rgt' => 16,
            'depth' => 1,
        ]);
    }
}
