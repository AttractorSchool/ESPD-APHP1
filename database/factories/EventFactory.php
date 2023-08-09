<?php

namespace Database\Factories;

use Carbon\Carbon;
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
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'date' => $this->faker->date,
            'location' => $this->faker->address,
            'format' => $this->faker->randomElement(['online', 'offline']),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'picture' => $this->getImage(rand(1,5)),
            'author_id' => rand(1,10),
            'quantity' => rand(5,10)
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
