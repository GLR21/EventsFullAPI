<?php

namespace Tests\Feature;

use App\Mail\SubscriptionEmail;
use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SubscriptionControllerSendSubscriptionsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the sendSubscriptions method.
     *
     * @return void
     */
    public function testSendSubscriptions()
    {
        $subscriptions = Subscription::factory()->count(5)->create();

        $user_id = $subscriptions[0]->ref_user;

        // Mock the mail sending
        Mail::fake();

        // Make a GET request to the sendSubscriptions route with the BEARER token
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . env('API_TOKEN'),
        ])->getJson("/api/v1/subscription/{$user_id}/email");

        // Assert the response status
        $response->assertStatus(200);

        // Assert the mail was sent
        Mail::assertSent(SubscriptionEmail::class, function ($mail) use ($user_id) {
            return $mail->hasTo(env('MAILTRAP_EMAIL_TEST_RECEIVER'));
        });
    }
}
