<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CitySeeder::class,
            SubscriptionSeeder::class,
            InterestSeeder::class,
            UserSeeder::class,
            UserInterestSeeder::class,
            EventSeeder::class,
            ResponseSeeder::class,
            MessageSeeder::class,
            UserRoleSeeder::class,
            MentorDataSeeder::class,
            CourseSeeder::class,
            VideoSeeder::class,
            QuestionSeeder::class,
            AnswerSeeder::class,
            UserCourseSeeder::class,
            CommentSeeder::class,
            ReviewSeeder::class,
            UserEventSeeder::class,
            MentorSeeder::class,
            FavouriteSeeder::class,
            CustomNotificationSeeder::class
        ]);
    }
}
