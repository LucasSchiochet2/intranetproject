<?php

namespace Database\Factories;

use App\Models\DocumentCategory;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Documents>
 */
class DocumentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory(),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph,
            'files' => ['https://pdfobject.com/pdf/sample.pdf'], // Generic external PDF
            'document_category_id' => DocumentCategory::factory(),
        ];
    }
}
