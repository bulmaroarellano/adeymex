<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SucursalUpdateRequest extends FormRequest
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
            'telefono' => ['required', 'max:255', 'string'],
            'email' => ['required', 'max:255', 'string'],
            'codigo_postal' => ['required', 'max:255', 'string'],
            'pais_id' => ['required', 'exists:paises,id'],
            'domicilio1' => ['required', 'max:255', 'string'],
            'domicilo2' => ['nullable', 'max:255', 'string'],
            'domicilio3' => ['nullable', 'max:255', 'string'],
        ];
    }
}
