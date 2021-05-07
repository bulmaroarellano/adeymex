<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CodigoPostalStoreRequest extends FormRequest
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
            'codigo_postal' => ['required', 'max:255', 'string'],
            'ciudad' => ['required', 'max:255', 'string'],
            'codigo_estado' => ['required', 'max:255', 'string'],
            'municipio' => ['required', 'max:255', 'string'],
            'direccion' => ['required', 'max:255', 'string'],
        ];
    }
}
