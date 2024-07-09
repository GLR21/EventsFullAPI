<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Users;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionControllerStoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the store method.
     *
     * @return void
     */
    public function testStore()
    {
        // Create a user and an event
        $user = Users::factory(1)->create()[0];
        $event = Event::factory(1)->create()[0];

        // Create a subscription payload
        $subscriptionPayload = [
            'ref_user' => $user->id,
            'ref_event' => $event->id,
            'dt_subscription' => now()->toDateString()
        ];

        // Make a POST request to the store route with the BEARER token
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . env('API_TOKEN'),
        ])->postJson('/api/v1/subscriptions/register', $subscriptionPayload);

        // Assert the response status
        $response->assertStatus(201);

        // Assert the response structure
        $response->assertJsonStructure([
            'data' => [
                'id',
                'ref_user',
                'ref_event',
                'dt_subscription',
                'dt_unsubscription',
                'dt_checkin',
                'dt_email_sent'
            ]
        ]);

        // Assert the subscription is in the database
        $this->assertDatabaseHas('subscriptions', [
            'ref_user' => $user->id,
            'ref_event' => $event->id
        ]);
    }
}
