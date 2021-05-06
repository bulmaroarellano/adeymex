<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MercanciaUpdateRequest extends FormRequest
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
            'producto' => ['required', 'max:255', 'string'],
            'producto_ingles' => ['required', 'max:255', 'string'],
            'clave_internacional' => ['nullable', 'max:255', 'string'],
            'costo' => ['nullable', 'max:255', 'string'],
            'medida' => ['nullable', 'max:255', 'string'],
            'peso' => ['required', 'max:255', 'string'],
            'pais_id' => ['required', 'exists:paises,id'],
            'moneda_id' => ['required', 'exists:monedas,id'],
            'unidad_id' => ['required', 'exists:unidades,id'],
        ];
    }
}
