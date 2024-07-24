<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class EventStartDateValidationTest extends TestCase
{
    use RefreshDatabase;

    public function testStartDate(): void
    {
        $data = [
            'name' =>fake('pt_BR')->sentence(3),
            'description' => fake('pt_BR')->paragraph(),
            'dt_start' => Carbon::now()->addDays(2)->toDateTimeString(),
            'dt_end' => Carbon::now()->toDateTimeString(),
            'dt_start_subscription' => Carbon::now()->toDateTimeString(),
            'dt_end_subscription' => Carbon::now()->addDay()->toDateTimeString(),
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . env('API_TOKEN'),
        ])->postJson('/api/v1/events/register', $data);

        $response->assertStatus(400)
            ->assertJson(['message' => 'Start date must be less than end date']);
    }
}
