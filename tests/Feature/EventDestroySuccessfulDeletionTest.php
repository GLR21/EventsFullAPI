<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Event;
use Carbon\Carbon;

class EventDestroySuccessfulDeletionTest extends TestCase
{
    use RefreshDatabase;

    public function testSuccessfulDestroy(): void
    {
        $event = Event::factory()->create([
            'dt_end' => Carbon::now()->addDay()->toDateTimeString()
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . env('API_TOKEN'),
        ])->delete("/api/v1/events/$event->id/delete",);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Event deleted']);

    }
}
