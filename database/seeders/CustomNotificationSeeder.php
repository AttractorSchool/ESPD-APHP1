<?php

namespace Database\Seeders;

use App\Models\CustomNotification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomNotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomNotification::factory([
            'sender_id' => 2,
            'user_id'   => 1,
            'type'      => 1
        ])->create();
            CustomNotification::factory([
                'sender_id' => 3,
                'user_id'   => 1,
                'type'      => 1
            ])->create();
            CustomNotification::factory([
                'sender_id' => 4,
                'user_id'   => 1,
                'type'      => 1
            ])->create();
            CustomNotification::factory([
                'sender_id' => 5,
                'user_id'   => 1,
                'type'      => 1
            ])->create();
            CustomNotification::factory([
                'sender_id' => 6,
                'user_id'   => 1,
                'type'      => 1
            ])->create();
    }
}
