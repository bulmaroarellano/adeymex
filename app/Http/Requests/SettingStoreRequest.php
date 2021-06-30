<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingStoreRequest extends FormRequest
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
            'bussines_name' => ['required', 'max:255', 'string'],
            'telephone' => ['required', 'max:255', 'string'],
            'email' => ['required', 'email'],
            'logo' => ['required', 'max:255', 'string'],
            'discount_credit_card' => ['required', 'numeric'],
        ];
    }
}
