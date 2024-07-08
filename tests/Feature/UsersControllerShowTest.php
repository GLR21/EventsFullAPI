<?php

namespace Tests\Feature;

use App\Models\Users;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersControllerShowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the show method.
     *
     * @return void
     */
    public function testShow()
    {
        // Create a user and obtain a token
        $user = Users::factory()->create();

        // Make a GET request to the show route with the BEARER token
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . env('API_TOKEN'),
        ])->getJson("/api/v1/users/{$user->id}");

        // Assert the response status
        $response->assertStatus(200);

        // Assert the response structure
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
                'document',
                'password'
            ]
        ]);
    }
}
