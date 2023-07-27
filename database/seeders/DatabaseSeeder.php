<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\City;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        \App\Models\User::factory()->create(
//            [
//                'email' => 'admin@admin.com',
//                'name' => 'admin',
////                'city' => rand(1, count(City::all())),
//                'permissions' => [
//                    "platform.index" => true,
//                    "platform.systems.roles" => true,
//                    "platform.systems.users" => true,
//                    "platform.systems.attachment" => true
//                ]
//            ]
//        );

        $this->call(CitySeeder::class);
        $this->call(SubscriptionSeeder::class);
        $this->call(InterestSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UserInterestSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(ReviewSeeder::class);
        $this->call(ResponseSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(MentorDataSeeder::class);
    }
}
