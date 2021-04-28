<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MercanciaRequest extends FormRequest
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
            'producto' => 'required', 
            'productoIngles' => 'nullable', 
            'claveInternacional' => 'required', 
            'costo' => 'required', 
            'moneda' => 'nullable', 
            'unidadMedida' => 'nullable', 
            'pais' => 'nullable', 
            'peso' => 'nullable', 
        ];
    }
}
