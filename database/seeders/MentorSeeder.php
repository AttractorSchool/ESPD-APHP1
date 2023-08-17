<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class MentorSeeder extends Seeder
{
    public function run()
    {
        $mentorRole = Role::create([
            'name' => 'mentor',
            'slug' => 'mentor',
        ]);

        $users = User::limit(10)->get();

        foreach ($users as $user) {
            $user->roles()->attach($mentorRole);
        }
    }
}
