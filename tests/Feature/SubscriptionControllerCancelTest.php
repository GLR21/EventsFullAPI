<?php

namespace Tests\Feature;

use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionControllerCancelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the cancel method.
     *
     * @return void
     */
    public function testCancel()
    {
        // Create a subscription
        $subscription = Subscription::factory()->create();

        // Make a POST request to the cancel route with the BEARER token
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . env('API_TOKEN'),
        ])->postJson("/api/v1/subscriptions/{$subscription->id}/cancel");

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

        // Assert the subscription is updated in the database
        $this->assertDatabaseHas('subscriptions', [
            'id' => $subscription->id,
            'dt_unsubscription' => now()
        ]);
    }
}
