<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubscriptionRequest extends FormRequest
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

        switch( $this->method() )
        {
            case 'PUT':
                return
                [
                    'ref_user' =>           ['required',  'exists:users,id' ],
                    'ref_event' =>          ['required' , 'exists:events,id'],
                    'dt_subscription' =>    ['required' , 'date'],
                    'dt_unsubscription' =>  ['required' , 'nullable' , 'date'],
                    'dt_checkin' =>         ['required' , 'nullable' , 'date'],
                    'dt_email_sent' =>      ['required' , 'nullable' , 'date'],
                ];
            break;

            case 'PATCH':
            return
                    [
                        'ref_user' =>           [ 'sometimes', 'required',  'exists:users,id' ],
                        'ref_event' =>          [ 'sometimes', 'required' , 'exists:events,id'],
                        'dt_subscription' =>    [ 'sometimes', 'required' , 'date'],
                        'dt_unsubscription' =>  [ 'sometimes', 'required' , 'nullable' , 'date'],
                        'dt_checkin' =>         [ 'sometimes', 'required' , 'nullable' , 'date'],
                        'dt_email_sent' =>      [ 'sometimes', 'required' , 'nullable' , 'date'],
                    ];
            break;
        }
    }
}
