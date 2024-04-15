<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ref_user' => Users::factory(),
            'ref_event' => Event::factory(),
            'dt_subscription' => null,
            'dt_unsubscription' => null,
            'dt_checkin' => null,
            'dt_email_sent' => null
        ];
    }
}
