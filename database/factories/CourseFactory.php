<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
            'author_id'        => 5,
            'interest_id'      => rand(1, 10),
            'mini_description' => $this->faker->text,
            'description'      => $this->faker->text,
            'photo' => $this->getImage(rand(1,5))
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
