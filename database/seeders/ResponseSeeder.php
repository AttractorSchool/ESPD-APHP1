<?php

namespace Database\Seeders;

use App\Models\Response;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            $randomUserId = $users->whereNotIn('id', [$user->id])->pluck('id')->random();

            Response::factory()->create([
                'first_id' => $user->id,
                'second_id' => $randomUserId,
                'confirm_first' => false,
                'confirm_second' => false,
            ]);
        }
    }
}
