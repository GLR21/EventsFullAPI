<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Event;
use App\Models\Subscription;

class EventDestroySubscriptionValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_example(): void
    {

        $event = Event::factory()->create();
        Subscription::factory()->create(['ref_event' => $event->id]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . env('API_TOKEN'),
        ])->delete("/api/v1/events/$event->id/delete",);

        $response->assertStatus(400)->assertJson(['message' => 'Event has subscriptions']);
    }
}
