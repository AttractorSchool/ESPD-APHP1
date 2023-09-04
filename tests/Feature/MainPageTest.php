<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Event;
use App\Models\Interest;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserInterest;
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

//    не работает главная страница
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

    public function test_networking_without_login(): void
    {
        $response = $this->get(route('networking'));

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_networking_with_login_without_buy_subscriptions(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('networking'));

        $response->assertStatus(302);
        $response->assertRedirect(route('subscriptions'));
    }

    public function test_networking_with_login_show_name(): void
    {
        $interest = Interest::factory()->create();
        $user2 = User::factory()->create();

        $user = User::factory()->create();
        Subscription::create([
            'type' => 'Free',
            'description' => 'Доступ к блаблабла',
            'price' => 0,
        ]);

        $user2_interest = new UserInterest();
        $user2_interest->user_id = $user2->id;
        $user2_interest->interest_id = $interest->id;
        $user2_interest->save();
        $user_interest = new UserInterest();
        $user_interest->user_id = $user->id;
        $user_interest->interest_id = $interest->id;
        $user_interest->save();

        $startDate = Carbon::now();
        $startDate->addDays(7);

        $subscrate = new UserSubscription();
        $subscrate->user_id = $user->id;
        $subscrate->subscription_id = 1;
        $subscrate->start_date = Carbon::now();
        $subscrate->end_date = $startDate->toDateTimeString();
        $subscrate->save();

        $this->actingAs($user);

        $response = $this->get(route('networking'));

        $response->assertStatus(200);
        $response->assertSeeText('Люди, которых вы можете знать');
    }

    public function test_connect_without_login(): void
    {
        $response = $this->post(route('connect'));

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_connect_with_login_without_buy_subscriptions(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('connect'));

        $response->assertStatus(302);
        $response->assertRedirect(route('subscriptions'));
    }

//    не работает кнопка подключиться
//    public function test_connect_with_login_make_in_db_connecting(): void
//    {
//        $user2 = User::factory()->create();
//
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
//        $request = ['second_id' => $user2->id];
//
//        $response = $this->post(route('connect', $request));
//
//        $response->assertStatus(200);
//        $response->assertSeeText('Люди, которых вы можете знать');
//    }

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

    public function test_Mentors_test_with_login_without_buy_subscriptions(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('mentorship.test'));

        $response->assertStatus(302);
        $response->assertRedirect(route('subscriptions'));
    }

    public function test_Mentors_test_without_login(): void
    {
        $response = $this->get(route('mentorship.test'));

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_Mentors_test_with_login_show_question(): void
    {
        $questions = Interest::factory(4)->create();
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

        $response = $this->get(route('mentorship.test'));

        $response->assertStatus(200);
        $response->assertSeeText('Что из нижеперечисленного вам по душе?');
        $response->assertSeeText($questions[0]->name);
        $response->assertSeeText($questions[1]->name);
        $response->assertSeeText($questions[2]->name);
        $response->assertSeeText($questions[3]->name);
    }

    public function test_show_mentors_past_test_with_login_without_buy_subscriptions(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('mentorship.result'));

        $response->assertStatus(302);
        $response->assertRedirect(route('subscriptions'));
    }

    public function test_show_mentors_past_test_without_login(): void
    {
        $response = $this->post(route('mentorship.result'));

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_show_mentors_past_test_with_login_show_question(): void
    {
        $questions = Interest::factory(4)->create();

        $mentor = User::factory()->create();

        $role = new Role();
        $role->slug = 'mentor';
        $role->name = 'mentor';
        $role->save();

        $mentorRole = Role::where('name', 'mentor')->first();
        $mentor->roles()->attach($mentorRole);
        $description = 'Описание ментора.';

        UserInterest::create([
            'user_id' => $mentor->id,
            'interest_id' => $questions[0]->id,
        ]);

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

        $request = ['interest' => $questions[0]->id];
        $response = $this->post(route('mentorship.result', $request));

        $response->assertStatus(200);
        $response->assertSeeText('Рекомендуемый ментор');
        $response->assertSeeText('Имя ментора:');
        $response->assertSeeText($mentor->name);
        $response->assertSeeText('Схожий интерес:');
        $response->assertSeeText($questions[0]->name);
    }

    public function test_show_mentor_with_login_without_buy_subscriptions(): void
    {
        $questions = Interest::factory(4)->create();

        $mentor = User::factory()->create();

        $role = new Role();
        $role->slug = 'mentor';
        $role->name = 'mentor';
        $role->save();

        $mentorRole = Role::where('name', 'mentor')->first();
        $mentor->roles()->attach($mentorRole);
        $description = 'Описание ментора.';

        UserInterest::create([
            'user_id' => $mentor->id,
            'interest_id' => $questions[0]->id,
        ]);

        DB::table('users')->where('id', $mentor->id)->update([
            'description' => $description,
        ]);

        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('mentors.show', $mentor->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('subscriptions'));
    }

    public function test_show_mentor_past_test_without_login(): void
    {
        $questions = Interest::factory(4)->create();

        $mentor = User::factory()->create();

        $role = new Role();
        $role->slug = 'mentor';
        $role->name = 'mentor';
        $role->save();

        $mentorRole = Role::where('name', 'mentor')->first();
        $mentor->roles()->attach($mentorRole);
        $description = 'Описание ментора.';

        UserInterest::create([
            'user_id' => $mentor->id,
            'interest_id' => $questions[0]->id,
        ]);

        DB::table('users')->where('id', $mentor->id)->update([
            'description' => $description,
        ]);

        $response = $this->get(route('mentors.show', $mentor->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_show_mentor_past_test_with_login_show_question(): void
    {
        $questions = Interest::factory(4)->create();

        $mentor = User::factory()->create();

        $role = new Role();
        $role->slug = 'mentor';
        $role->name = 'mentor';
        $role->save();

        $mentorRole = Role::where('name', 'mentor')->first();
        $mentor->roles()->attach($mentorRole);
        $description = 'Описание ментора.';

        UserInterest::create([
            'user_id' => $mentor->id,
            'interest_id' => $questions[0]->id,
        ]);

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

        $response = $this->get(route('mentors.show', $mentor->id));

        $response->assertStatus(200);
        $response->assertSeeText('проголосовавших');
        $response->assertSeeText($mentor->name);
        $response->assertSeeText($mentor->city);
        $response->assertSeeText($mentor->description);
        $response->assertSeeText('Материалы от');
        $response->assertSeeText($mentor->name);
        $response->assertSeeText('Забронировать сессию');
    }

    public function test_events_with_login_without_buy_subscriptions(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('events_main'));

        $response->assertStatus(302);
        $response->assertRedirect(route('subscriptions'));
    }

    public function test_events_without_login(): void
    {
        $response = $this->get(route('events_main'));

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_events_with_login_show_question(): void
    {
        $user = User::factory()->create();
        Subscription::create([
            'type' => 'Free',
            'description' => 'Доступ к блаблабла',
            'price' => 0,
        ]);

        $city = City::create([
            'name' => 'Алматы'
        ]);
        $events = Event::factory(20)->create([
            'city_id' => $city->id,
            'author_id' => 1
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

        $response = $this->get(route('events_main'));

        $response->assertStatus(200);
        $response->assertSeeText('Предстоящие мероприятия');
        $response->assertSeeText($events[0]->name);
//        $response->assertSeeText(date('d', strtotime($events[0]->date)));
//        $response->assertSeeText(date('M', strtotime($events[0]->date)));
        $response->assertSeeText('участников');
        $response->assertSeeText('Пригласить своих друзей');
        $response->assertSeeText('Пригласить');
    }
}
