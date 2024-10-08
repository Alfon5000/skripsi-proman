<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => random_int(1, 3),
            'manager_id' => random_int(2, 3),
            'name' => ucfirst(fake()->words(asText: true)),
            'description' => ucfirst(fake()->paragraph(2)),
            'budget' => random_int(100000000, 1000000000),
            'start_time' => fake()->dateTimeBetween('-3 months'),
            'end_time' => fake()->dateTimeBetween('now', '+3 months'),
        ];
    }
}
