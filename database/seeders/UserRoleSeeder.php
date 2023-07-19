<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $mentorRole = Role::where('name', 'mentor')->first();
        $residentRole = Role::where('name', 'resident')->first();

        $mentorUsers = User::whereIn('id', [11, 12, 13, 14, 15, 16, 17, 18, 19, 20])->get();
        $residentUsers = User::whereIn('id', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10])->get();

        foreach ($mentorUsers as $user) {
            $user->roles()->attach($mentorRole);

            $description = $this->generateDescription();

            DB::table('users')->where('id', $user->id)->update([
                'description' => $description,
            ]);
        }

        foreach ($residentUsers as $user) {
            $user->roles()->attach($residentRole);
        }
    }

    /**
     * @return string
     */
    private function generateDescription(): string
    {
        return 'Описание ментора.';
    }
}
