<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => ['required', 'exists:customers,id'],
            'guests_number' => ['required', 'numeric'],
            'date' => ['nullable', 'date', 'date'],
            'start_our' => ['required', 'date_format:H:i:s'],
            'start_end' => ['required', 'date_format:H:i:s'],
        ];
    }
}
