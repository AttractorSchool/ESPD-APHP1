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
//        $role_date = [
//            [   'id' => 1,
//                'slug' => 'mentor',
//            ]
//        ];
//        $role_user_date = [
//          [
//              'user_id' => '2',
//              'role_id' =>  '1'
//          ]
//        ];
//        DB::table('role_users')->insert($role_date);
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
            ReviewSeeder::class,
            UserEventSeeder::class,
            MentorSeeder::class,
            FavouriteSeeder::class,
        ]);
    }
}
