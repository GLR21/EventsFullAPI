<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class EventSubscriptionDateRangeValidationTest extends TestCase
{
    use RefreshDatabase;

    // Test if the subscription dates are within or before the event dates
    public function testSubscriptionDatesInterval(): void
    {
        $data =
        [
            'name' => fake('pt_BR')->sentence(3),
            'description' => fake('pt_BR')->paragraph(),
            'dt_start' => Carbon::now()->addDays(5)->toDateTimeString(),
            'dt_end' => Carbon::now()->addDays(10)->toDateTimeString(),
            'dt_start_subscription' => Carbon::now()->addDays(6)->toDateTimeString(),
            'dt_end_subscription' => Carbon::now()->addDays(12)->toDateTimeString(),
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . env('API_TOKEN'),
        ])->postJson('/api/v1/events/register', $data);

        $response->assertStatus(400)
            ->assertJson(['message' => 'Subscription dates must be either within the event dates or entirely before the event dates']);
    }
}
