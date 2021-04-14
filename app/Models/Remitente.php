<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remitente extends Model
{
    use HasFactory;

    protected $fillable = [
        'sucursal',
        'nombre',
        'apellidoP',
        'apellidoM',
        'empresa',
        'telefono',
        'email',
        'tipoCliente',
        'domicilio1',
        'domicilio2',
        'domicilio3',
        'pais',
        'codigoPostal',
    ];
}
