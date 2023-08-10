<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
            'title' => $this->faker->text(20),
            'description' => $this->faker->sentence,
            'date' => $this->faker->dateTimeBetween('-2month', '+3 month'),
            'location' => $this->faker->address,
            'format' => $this->faker->randomElement(['online', 'offline']),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'picture' => $this->getImage(rand(1,5)),
            'city_id'  => rand(1, 5)
        ];
    }

    private function getImage(int $imageNumber = 1): string
    {
        $path = storage_path() . "/avatars/" . $imageNumber . ".jpeg";
        $imageName = md5($path) . '.jpeg';
        $image = 'pictures/' . $imageName;
        $resize = Image::make($path)->fit(300)->encode('jpeg');
        Storage::disk('public')->put('pictures/'.$imageName, $resize->__toString());
        return $image;
    }
}
