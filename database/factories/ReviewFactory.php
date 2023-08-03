<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_id' => rand(11, 20),
            'user_id'   => rand(1,10),
            'body'      => $this->faker->realTextBetween(10, 50),
            'rating'    => rand(1,5),
//            'course_id' => null
        ];
    }
}
