<?php

namespace Tests\Feature;

use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionControllerIndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index method.
     *
     * @return void
     */
    public function testIndex()
    {
        // Create some subscriptions
        Subscription::factory()->count(3)->create();

        // Make a GET request to the index route with the BEARER token
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . env('API_TOKEN'),
        ])->getJson('/api/v1/subscriptions');

        // Assert the response status
        $response->assertStatus(200);

        // Assert the response structure
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'ref_user',
                    'ref_event',
                    'dt_subscription',
                    'dt_unsubscription',
                    'dt_checkin',
                    'dt_email_sent'
                ]
            ]
        ]);
    }
}
