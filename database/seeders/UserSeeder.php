<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create(
            [
                'email' => 'admin@admin.com',
                'name' => 'admin',
                'lastname' => 'admin',
                'country' => 'KAZ',
                'city' => 'Алмата',
                'permissions' => [
                    "platform.index" => true,
                    "platform.systems.roles" => true,
                    "platform.systems.users" => true,
                    "platform.systems.attachment" => true
                ]
            ]

        );

         User::factory(25)->create();

    }
}
