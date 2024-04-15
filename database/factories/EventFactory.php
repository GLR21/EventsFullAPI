<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Test '. fake()->title(),
            'description' => 'Test ' . fake()->text(200),
            'dt_start' => now()->addDays(7),
            'dt_end' => now()->addDays(7)->addHours(4),
            'dt_start_subscription' => now(),
            'dt_end_subscription' => now()->addDays(5)
        ];
    }
}
