<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_id' => random_int(1, 2),
            'title' => ucfirst(fake()->word(3)),
            'description' => ucfirst(fake()->paragraph(1)),
            'start_time' => fake()->dateTimeBetween('-1 month'),
            'end_time' => fake()->dateTimeBetween('now', '+1 month'),
            'color' => fake()->hexColor(),
            'textColor' => fake()->hexColor(),
        ];
    }
}
