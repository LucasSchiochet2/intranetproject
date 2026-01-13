<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
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
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->sentence,
            'image_url' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=1200&q=80', // Office placeholder
            'link_url' => '#',
            'is_active' => true,
            'display_order' => $this->faker->numberBetween(1, 10),
        ];
    }
}
