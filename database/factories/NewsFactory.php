<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence;

        $images = [
            'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=800&q=80',
            'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&q=80',
            'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=800&q=80',
            'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=800&q=80',
            'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=800&q=80',
            'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=800&q=80'
        ];

        return [
            'tenant_id' => null,
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraphs(3, true),
            'photos' => $this->faker->randomElements($images, $this->faker->numberBetween(1, 4)),
            'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
