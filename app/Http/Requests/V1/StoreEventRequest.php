<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'dt_start' => ['required' , 'date'],
            'dt_end' => ['required' , 'date'],
            'dt_start_subscription' => ['required' , 'date'],
            'dt_end_subscription' => ['required' , 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'description.required' => 'Description is required',
            'dt_start.required' => 'Start date is required',
            'dt_start.date' => 'Start date must be a date',
            'dt_end.required' => 'End date is required',
            'dt_end.date' => 'End date must be a date',
            'dt_start_subscription.required' => 'Subscription start date is required',
            'dt_start_subscription.date' => 'Subscription start date must be a date',
            'dt_end_subscription.required' => 'Subscription end date is required',
            'dt_end_subscription.date' => 'Subscription end date must be a date',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => $this->name,
            'description' => $this->description,
            'dt_start' => $this->dt_start,
            'dt_end' => $this->dt_end,
            'dt_start_subscription' => $this->dt_start_subscription,
            'dt_end_subscription' => $this->dt_end_subscription
        ]);
    }
}
