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
        User::factory()->create([
           'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'phone' => '87019241146',
            'country' => 'Kazahstan',
            'city' => '10',
            'permissions' => '{"platform.index": true, "platform.systems.roles": true, "platform.systems.users": true, "platform.systems.attachment": true}'
        ]);
         User::factory(25)->create();

    }
}
