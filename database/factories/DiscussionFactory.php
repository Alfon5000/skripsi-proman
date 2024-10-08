<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discussion>
 */
class DiscussionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'creater_id' => random_int(2, 20),
            'project_id' => random_int(1, 20),
            'department_id' => random_int(1, 4),
            'title' => ucfirst(fake()->words(asText: true)),
            'description' => ucfirst(fake()->paragraph(1)),
        ];
    }
}
