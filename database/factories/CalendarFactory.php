<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Calendar>
 */
class CalendarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('now', '+1 month');
        return [
            'tenant_id' => Tenant::factory(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'start_date' => $start,
            'end_date' => (clone $start)->modify('+1 hour'),
        ];
    }
}
