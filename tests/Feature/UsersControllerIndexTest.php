<?php

namespace Tests\Feature;

use App\Models\Users;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersControllerIndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index method.
     *
     * @return void
     */
    public function testIndex()
    {
        // Create some users
        Users::factory()->count(3)->create();

        // Make a GET request to the index route
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . env('API_TOKEN')
        ])->
        getJson('/api/v1/users');

        // Assert the response status
        $response->assertStatus(200);

        // Assert the response structure
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'email',
                    'document',
                    'password'
                ]
            ]
        ]);
    }
}
