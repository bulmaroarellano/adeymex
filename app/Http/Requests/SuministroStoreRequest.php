<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuministroStoreRequest extends FormRequest
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
            'nombre' => ['required', 'max:255', 'string'],
            'costo' => ['required', 'max:255', 'string'],
            'precio_publico' => ['required', 'max:255', 'string'],
            'sucursal_id' => ['required', 'exists:sucursales,id'],
        ];
    }
}