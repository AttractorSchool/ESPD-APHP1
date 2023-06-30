<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['free', 'standard', 'premium']),
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'description' => $this->faker->realTextBetween(30, 90),
            'price' => rand(100, 999)
        ];
    }
}
