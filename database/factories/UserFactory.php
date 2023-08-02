<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cities = ['Алматы', 'Караганда', 'Астана'];

        return [
            'name' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone' => $this->faker->unique()->phoneNumber,
            'country' => $this->faker->country,
            'city' => $cities[rand(0,2)],
            'remember_token' => Str::random(10),
            'avatar' => $this->getImage(rand(1,5))
        ];
    }

    /**
     * @param int $imageNumber
     * @return string
     */
    private function getImage(int $imageNumber = 1): string
    {
        $path = storage_path() . "/avatars/" . $imageNumber . ".jpeg";
        $imageName = md5($path) . '.jpeg';
        $image = 'pictures/' . $imageName;
        $resize = Image::make($path)->fit(300)->encode('jpeg');
        Storage::disk('public')->put('pictures/'.$imageName, $resize->__toString());

        return $image;
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
