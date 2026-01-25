<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ombudsman>
 */
class OmbudsmanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tenant_id' => null,
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'type' => $this->faker->randomElement(['complaint', 'suggestion', 'compliment']),
            'subject' => $this->faker->sentence,
            'message' => $this->faker->paragraph,
            'status' => 'open',
            'response_token' => Str::upper(Str::random(12)),
        ];
    }
}
