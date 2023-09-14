<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     */
    public function testUserRegistrationLoginAndLogout()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1170, 2532);

            $browser->visit('/register')
                ->type('name', 'John')
                ->type('lastname', 'Doe')
                ->type('email', 'b23@example.com')
                ->type('phone', '244')
                ->type('country', 'United States')
                ->type('city', 'New York')
                ->type('password', 'password123')
                ->press('Зарегистрироваться')
                ->assertSee('John')
                ->click('#navbarDropdown')
                ->screenshot('logout')
                ->clickLink('Logout')

                ->screenshot('login')
                ->assertPathIs('/login')
                ->clickLink('Login')
                ->assertSee('Login')
                ->type('email', 'b23@example.com')
                ->type('password', 'password123')
                ->press('Continue')
                ->assertSee('John')
                ->assertPathIs('/subscriptions')
                 ->screenshot('home');

        });
    }
}
