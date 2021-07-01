<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CotizarRequest extends FormRequest
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
            'sucursal_id'     => 'required', 
            'destino'         => 'required', 
            'country_code'    => 'required', 
            'cargo_logistica' => 'required', 
            'type_paquete.*'    => 'required', 
            'largo.*' => 'required', 
            'ancho.*' => 'required', 
            'peso.*'  => 'required', 
        ];
    }
}
