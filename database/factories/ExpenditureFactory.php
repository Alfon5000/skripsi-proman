<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expenditure>
 */
class ExpenditureFactory extends Factory
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
            'uploader_id' => random_int(2, 20),
            'title' => ucfirst(fake()->words(asText: true)),
            'description' => ucfirst(fake()->paragraph(1)),
            'date' => fake()->date(),
            'amount' => random_int(100000, 1000000),
            'evidence' => fake()->word(),
        ];
    }
}
