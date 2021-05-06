<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RemitenteStoreRequest extends FormRequest
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
            'apellido_paterno' => ['required', 'max:255', 'string'],
            'apellido_materno' => ['nullable', 'max:255', 'string'],
            'telefono' => ['required', 'max:255', 'string'],
            'email' => ['nullable', 'email'],
            'cliente_id' => ['required', 'exists:clientes,id'],
            'empresa_id' => ['nullable', 'exists:empresas,id'],
            'domicilio1' => ['required', 'max:255', 'string'],
            'domicilio2' => ['nullable', 'max:255', 'string'],
            'domicilio3' => ['nullable', 'max:255', 'string'],
            'codigo_postal' => ['required', 'max:255', 'string'],
            'sucursal_id' => ['required', 'exists:sucursales,id'],
            'pais_id' => ['required', 'exists:paises,id'],
        ];
    }
}
