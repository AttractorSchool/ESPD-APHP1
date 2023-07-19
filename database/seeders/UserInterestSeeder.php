<?php

namespace Database\Seeders;

use App\Models\Interest;
use App\Models\User;
use App\Models\UserInterest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserInterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $interests = Interest::all();

        foreach ($users as $user) {
            $userInterests = $interests->random(3);
            foreach ($userInterests as $interest) {
                UserInterest::create([
                    'user_id' => $user->id,
                    'interest_id' => $interest->id,
                ]);
            }
        }
    }
}
