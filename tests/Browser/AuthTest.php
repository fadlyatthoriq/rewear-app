<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AuthTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testUserCanRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                   ->type('input[name="name"]', 'John Doe')
                   ->type('input[name="email"]', 'john@example.com')
                   ->type('input[name="password"]', 'password123')
                   ->type('input[name="password_confirmation"]', 'password123')
                   ->press('button[type="submit"]')
                   ->assertPathIs('/dashboard')
                   ->assertSee('Welcome');
        });
    }

    public function testUserCanLogin()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                   ->type('input[name="email"]', $user->email)
                   ->type('input[name="password"]', 'password123')
                   ->press('button[type="submit"]')
                   ->assertPathIs('/dashboard')
                   ->assertSee('Welcome');
        });
    }

    public function testUserCannotLoginWithWrongCredentials()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                   ->type('input[name="email"]', 'wrong@example.com')
                   ->type('input[name="password"]', 'wrongpassword')
                   ->press('button[type="submit"]')
                   ->assertPathIs('/login')
                   ->assertSee('These credentials do not match our records');
        });
    }
} 