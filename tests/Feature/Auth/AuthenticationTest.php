<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create([
            'username' => 'comp1',
            'password' => bcrypt('comp1pass'),
        ]);

        $response = $this->post('/login', [
            'username' => 'comp1',
            'password' => 'comp1pass',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'username' => 'comp1',
            'password' => 'comp1pas',
        ]);

        $this->assertGuest();
    }

    public function test_users_can_logout(): void
    {
        // $user = User::factory()->create();
        $user = User::factory()->create([
            'username' => 'comp1',
            'password' => bcrypt('comp1pass'),
        ]);

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
