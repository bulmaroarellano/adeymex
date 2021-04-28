<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RemitenteRequest extends FormRequest
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
            'nombre' => 'required',
            'apellidoP' => 'required',
            'apellidoM' => 'nullable',
            'empresa' => 'nullable',
            'telefono' => 'required|min:10',
            'email' => 'nullable|email:rfc,dns',
            'tipoCliente' => 'required',
            'domicilio1' => 'required',
            'domicilio2' => 'nullable',
            'domicilio3' => 'nullable',
            'pais' => 'required',
            'codigoPostal' => 'required|max:5',
        ];
    }

}
