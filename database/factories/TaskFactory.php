<?php

namespace Database\Factories;

use App\Models\Collaborators;
use App\Models\Dashboard;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph,
            'is_completed' => $this->faker->boolean(20),
            'deadline' => $this->faker->dateTimeBetween('now', '+1 month'),
            'collaborator_id_sender' => Collaborators::factory(),
            'collaborator_id_receiver' => Collaborators::factory(),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed']),
            'tag' => $this->faker->word,
            'attachment' => [],
            'is_archived' => $this->faker->boolean(10),
            'dashboard_id' => Dashboard::factory(),
        ];
    }
}
