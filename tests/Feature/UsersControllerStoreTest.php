<?php

namespace Tests\Feature;

use App\Models\Users;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersControllerStoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the store method.
     *
     * @return void
     */
    public function testStore()
    {
        // Create a user and obtain a token
        $user = Users::factory()->create();

        // Create a user payload
        $userPayload = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'document' => '123456789',
            'password' => 'password'
        ];

        // Make a POST request to the store route with the BEARER token
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . env('API_TOKEN'),
        ])->postJson('/api/v1/users/register', $userPayload);

        // Assert the response status
        $response->assertStatus(201);

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

        // Assert the user is in the database
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com'
        ]);
    }
}
