<?php

namespace Tests\Feature\SumberEmisi;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SumberEmisiLandingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * User berhasil mengakses halaman /emisi setelah login.
     */
    public function test_user_can_access_emisi_page_after_login(): void
    {
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'username' => 'comp1',
            'password' => 'comp1pass',
        ]);
        $response->assertStatus(200);
    }

    /**
     * User gagal mengakses halaman /emisi jika belum login.
     */
    public function test_guest_cannot_access_emisi_page(): void
    {
        $response = $this->get('/emisi');
        $response->assertRedirect('/login');
    }
}
