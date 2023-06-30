<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subscription::factory()->create(['type' => 'free', 'price' => 0]);
        Subscription::factory()->create(['type' => 'standard']);
        Subscription::factory()->create(['type' => 'premium']);
    }
}
