<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
            'dni' => ['nullable', 'unique:customers', 'max:255', 'string'],
            'fiscal_code' => ['nullable', 'max:255', 'string'],
            'firstname' => ['required', 'max:255', 'string'],
            'lastname' => ['required', 'max:255', 'string'],
            'telephone' => ['nullable', 'max:255', 'string'],
            'email' => ['nullable', 'email'],
            'company_name' => ['nullable', 'max:255', 'string'],
        ];
    }
}
