<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SucursalRequest extends FormRequest
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
            'sucursal' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'encargado' => 'required',
            'domicilio1' => 'required',
            'domicilio2' => 'required',
            'domicilio3' => 'required',
            'pais' => 'required',
            'codigoPostal' => 'required',
        ];
    }
}
