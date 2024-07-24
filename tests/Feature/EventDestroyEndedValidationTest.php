<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;
use App\Models\Event;

class EventDestroyEndedValidationTest extends TestCase
{
    use RefreshDatabase;

    public function testDestroyEndedValidation(): void
    {
        $event = Event::factory()->create([
            'dt_end' => Carbon::now()->subDay()->toDateTimeString()
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . env('API_TOKEN'),
        ])->delete("/api/v1/events/$event->id/delete",);

        $response->assertStatus(400)
            ->assertJson(['message' => 'Event has already ended']);
    }
}
