<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsersRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'document' => ['required' , 'string', 'unique:users,document', 'max:11' , 'min:8'],
            'password' => ['required' , 'string', 'min:8', 'max:16']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => $this->name,
            'email' => $this->email,
            'document' => $this->document,
            'password' => $this->password,
        ]);
    }
}
