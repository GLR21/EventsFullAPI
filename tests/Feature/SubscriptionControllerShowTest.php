<?php

namespace Tests\Feature;

use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionControllerShowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the show method.
     *
     * @return void
     */
    public function testShow()
    {
        // Create a subscription
        $subscription = Subscription::factory()->create();

        // Make a GET request to the show route with the BEARER token
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . env('API_TOKEN'),
        ])->getJson("/api/v1/subscriptions/{$subscription->id}");

        // Assert the response status
        $response->assertStatus(200);

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
    }
}
