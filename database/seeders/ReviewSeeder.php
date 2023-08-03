<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Review::factory()->create(            [
            'author_id'    => rand(11, 20),
            'user_id'      => null,
            'course_id' => 1,
            'body'      => 'Нормально',
            'rating'    => 4
        ]);
        Review::factory()->create(            [
            'author_id'    => rand(11, 20),
            'user_id'      => null,
            'course_id' => 1,
            'body'      => 'Все супер!',
            'rating'    => 5
        ]);
        Review::factory()->create(            [
            'author_id'    => rand(11, 20),
            'user_id'      => null,
            'course_id' => 1,
            'body'      => 'Пойдет',
            'rating'    => 3
        ]);
        Review::factory(20)->create();
    }
}
