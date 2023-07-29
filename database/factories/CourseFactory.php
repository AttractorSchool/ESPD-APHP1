<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'             => $this->faker->name,
            'author_id'        => '5',
            'interest_id'      => rand(1, 10),
            'mini_description' => $this->faker->text,
            'description'      => $this->faker->text,
        ];
    }
}
