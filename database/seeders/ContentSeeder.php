<?php

namespace Database\Seeders;

use App\Models\Calendar;
use App\Models\DocumentCategory;
use App\Models\Documents;
use App\Models\News;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // News
        News::factory(10)->create();

        // Calendar
        Calendar::factory(10)->create();

        // Documents and Categories
        $categories = DocumentCategory::factory(3)->create();
        
        $categories->each(function ($category) {
            Documents::factory(5)->create([
                'document_category_id' => $category->id
            ]);
        });
    }
}
