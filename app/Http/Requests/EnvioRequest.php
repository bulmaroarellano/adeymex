<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnvioRequest extends FormRequest
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
            'remitente_id' => 'required',
            'remitente_codigo_postal' => 'required',
            'remitente_pais' => 'required',
            'remitente_domicilio1' => 'required',
            'remitente_remitente_nombre_completo' => 'max:35',
            

            'destinatario_id' => 'required',
            'destinatario_codigo_postal' => 'required',
            'destinatario_pais' => 'required',
            'destinatario_domicilio1' => 'required',
            'destinatario_remitente_nombre_completo' => 'max:35',
    
            'largo_paquete.*' => 'required', 
            'ancho_paquete.*' => 'required', 
            'alto_paquete.*' => 'required', 
            'peso_paquete.*'  => 'required', 

        ];
    }
}
