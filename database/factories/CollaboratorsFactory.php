<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collaborators>
 */
class CollaboratorsFactory extends Factory
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
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password', // Mutator handles hashing
            'position' => $this->faker->jobTitle,
            'department' => $this->faker->words(2, true),
            'birth_date' => $this->faker->date(),
            'url_photo' => null, // 'uploads/collaborators/default.jpg'
        ];
    }
}
