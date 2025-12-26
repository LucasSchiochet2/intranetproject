<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Backpack\PageManager\app\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'template' => 'standard',
            'name' => 'About Us',
            'title' => 'About Us',
            'slug' => 'about-us',
            'content' => '<p>Welcome to our About Us page.</p>',
            'extras' => null,
        ]);
    }
}
