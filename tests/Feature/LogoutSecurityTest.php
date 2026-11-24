<?php

namespace Tests\Feature;

use Illuminate\Auth\GenericUser;
use Tests\TestCase;

class LogoutSecurityTest extends TestCase
{
    public function test_get_logout_is_not_allowed(): void
    {
        $user = new GenericUser(['id' => 1, 'name' => 'Test User', 'remember_token' => null]);

        $response = $this->actingAs($user)->get('/logout');

        $response->assertStatus(405);
        $this->assertAuthenticated();
    }

    public function test_post_logout_logs_user_out_safely(): void
    {
        $user = new GenericUser(['id' => 1, 'name' => 'Test User', 'remember_token' => null]);

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect();
        $this->assertGuest();
    }
}