<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'discussion_id' => random_int(1, 20),
            'commenter_id' => random_int(2, 20),
            'body' => ucfirst(fake()->paragraph(1)),
        ];
    }
}
