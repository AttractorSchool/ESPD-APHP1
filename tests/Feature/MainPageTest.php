<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class MainPageTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_mainPage_without_login(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_mainPage_with_login_without_buy_subscriptions(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertRedirect(route('subscriptions'));
    }

    public function test_allResidents_with_login_show_name(): void
    {
        $user = User::factory()->create();
        Subscription::create([
            'type' => 'Free',
            'description' => 'Доступ к блаблабла',
            'price' => 0,
        ]);

        $startDate = Carbon::now();
        $startDate->addDays(7);

        $subscrate = new UserSubscription();
        $subscrate->user_id = $user->id;
        $subscrate->subscription_id = 1;
        $subscrate->start_date = Carbon::now();
        $subscrate->end_date = $startDate->toDateTimeString();
        $subscrate->save();

        $this->actingAs($user);

        $response = $this->get(route('allResidents'));

        $response->assertStatus(200);
        $response->assertSeeText($user->name);
    }

    public function test_allResidents_without_login(): void
    {
        $response = $this->get(route('allResidents'));

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_allResidents_with_login_without_buy_subscriptions(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('allResidents'));

        $response->assertStatus(302);
        $response->assertRedirect(route('subscriptions'));
    }

    public function test_Mentors_with_login_without_buy_subscriptions(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('mentorship'));

        $response->assertStatus(302);
        $response->assertRedirect(route('subscriptions'));
    }

    public function test_Mentors_without_login(): void
    {
        $response = $this->get(route('mentorship'));

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_Mentors_with_login_show_name(): void
    {
        $mentor = User::factory()->create();

        $role = new Role();
        $role->slug = 'mentor';
        $role->name = 'mentor';
        $role->save();

        $mentorRole = Role::where('name', 'mentor')->first();
        $mentor->roles()->attach($mentorRole);
        $description = 'Описание ментора.';

        DB::table('users')->where('id', $mentor->id)->update([
            'description' => $description,
        ]);

        $user = User::factory()->create();
        Subscription::create([
            'type' => 'Free',
            'description' => 'Доступ к блаблабла',
            'price' => 0,
        ]);

        $startDate = Carbon::now();
        $startDate->addDays(7);

        $subscrate = new UserSubscription();
        $subscrate->user_id = $user->id;
        $subscrate->subscription_id = 1;
        $subscrate->start_date = Carbon::now();
        $subscrate->end_date = $startDate->toDateTimeString();
        $subscrate->save();

        $this->actingAs($user);

        $response = $this->get(route('mentorship'));

        $response->assertStatus(200);
        $response->assertSeeText($mentor->name);
    }

    //    public function test_mainPage_with_login_with_buy_subscriptions(): void
//    {
//        $user = User::factory()->create();
//        Subscription::create([
//            'type' => 'Free',
//            'description' => 'Доступ к блаблабла',
//            'price' => 0,
//        ]);
//
//        $startDate = Carbon::now();
//        $startDate->addDays(7);
//
//        $subscrate = new UserSubscription();
//        $subscrate->user_id = $user->id;
//        $subscrate->subscription_id = 1;
//        $subscrate->start_date = Carbon::now();
//        $subscrate->end_date = $startDate->toDateTimeString();
//        $subscrate->save();
//
//        $this->actingAs($user);
//
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
//        $response->assertSeeText('Чем «Woman Create» отличается от других сообществ?');
//    }
}
