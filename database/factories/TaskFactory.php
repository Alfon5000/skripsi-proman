<?php

namespace Database\Factories;

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
            'project_id' => random_int(1, 20),
            'worker_id' => random_int(2, 20),
            'priority_id' => random_int(1, 4),
            'status_id' => random_int(1, 4),
            'title' => ucfirst(fake()->word(3)),
            'description' => ucfirst(fake()->paragraph(1)),
            'start_time' => fake()->dateTimeBetween('-1 week'),
            'end_time' => fake()->dateTimeBetween('now', '+1 week'),
        ];
    }
}
