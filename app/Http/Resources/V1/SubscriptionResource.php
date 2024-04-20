<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ref_user' => $this->ref_user,
            'ref_event' => $this->ref_event,
            'dt_subscription' => $this->dt_subscription,
            'dt_unsubscription' => $this->dt_unsubscription,
            'dt_checkin' => $this->dt_checkin,
            'dt_email_sent' => $this->dt_email_sent
        ];
    }
}
