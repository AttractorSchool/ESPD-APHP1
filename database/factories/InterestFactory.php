<?php

namespace Database\Factories;

use App\Models\Interest;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Interest>
 */
class InterestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'name'    => $this->faker->unique()->word,
            'picture' => rand(1, 5)

        ];
    }
    /**
     * @param int $imageNumber
     * @return string
     */
    private function getImage(int $imageNumber = 1): string
    {
        $path      = storage_path() . "/seed_pictures/" . $imageNumber . ".jpg";
        $imageName = md5($path) . '.jpg';
        $image     = 'pictures/' . $imageName;
        $resize    = Image::make($path)->fit(300)->encode('jpg');
        Storage::disk('public')->put($image, $resize->__toString());

        return $image;
    }
}
