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
            'author_id'  => rand(11, 20),
            'course_id'  => rand(1,3),
            'body'       => $this->faker->realTextBetween(10, 50),
            'rating'     => rand(1,5),
        ];
    }
}
