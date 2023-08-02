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
        Subscription::create([
            'type' => 'Free',
            'description' => 'Доступ к блаблабла',
            'price' => 0,
        ]);

        Subscription::create([
            'type' => 'Standard',
            'description' => 'Доступ к блаблабла',
            'price' => 14990,
        ]);

        Subscription::create([
            'type' => 'Premium',
            'description' => 'Доступ к блаблабла',
            'price' => 59990,
        ]);
    }
}
