<?php

namespace Database\Seeders;

use App\Models\Rating;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MentorDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
//        $mentorRole = Role::where('name', 'mentor')->first();
//        $mentors = $mentorRole->users;
//
//        $users = User::all();
//
//        foreach ($mentors as $mentor) {
//            $numberOfRatings = rand(5, 15);
//
//            for ($i = 0; $i < $numberOfRatings; $i++) {
//                $ratedByUser = $users->random();
//
//                Rating::create([
//                    'user_id' => $mentor->id,
//                    'rated_by_user_id' => $ratedByUser->id,
//                    'rating' => $this->generateRating(),
//                ]);
//            }
//        }
    }

//    /**
//     * @return int
//     */
//    private function generateRating(): int
//    {
//        return rand(1, 5);
//    }
}
