<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ref_user' => ['required', 'exists:users,id' ],
            'ref_event' => ['required' , 'exists:events,id'],
            'dt_subscription' => ['required' , 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'ref_user.required' => 'User is required',
            'ref_user.exists' => 'User not found',
            'ref_event.required' => 'Event is required',
            'ref_event.exists' => 'Event not found',
            'dt_subscription.required' => 'Subscription date is required',
            'dt_subscription.date' => 'Subscription date must be a date',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'ref_user' => $this->ref_user,
            'ref_event' => $this->ref_event,
            'dt_subscription' => $this->dt_subscription,
        ]);
    }
}
