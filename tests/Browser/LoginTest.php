<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function registered_users_can_login()
    {
        // $user = User::factory()->create(['email' => 'example@email.com']);
        $user = User::factory()->create([
            'name' => 'example',
            'email' => 'example@email.com',
            'email_verified_at' => now(),
            'password' => '$2a$12$ZMEucXUgMnRTL.6ZnNKpMu3TKLFx2aOzljGJVrYae65hR4BEzGi.m', // secret
            'remember_token' => Str::random(10),
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email','example@email.com')
                    ->type('password','secret')
                    ->press('#btn-login')
                    ->assertPathIs('/')
                    ->assertAuthenticated();
        });
    }
}
