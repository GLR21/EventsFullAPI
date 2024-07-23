<?php

namespace Tests\Feature;

use Tests\TestCase;

class BearerTokenAuthTest extends TestCase
{
    public function unauthenticated_users_cannot_access_protected_route()
    {
        $response = $this->get('/api/v1/users');

        $response->assertStatus(401);
    }

    public function authenticated_users_can_access_protected_route()
    {
        $response = $this->get('/api/v1/users', [
            'Authorization' => "Bearer ".env('API_TOKEN'),
        ]);

        $response->assertStatus(200);
    }
}
