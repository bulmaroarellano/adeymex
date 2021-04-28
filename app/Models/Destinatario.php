<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Destinatario extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'sucursal', 
        'nombre', 
        'apellidoP', 
        'apellidoM', 
        'empresa', 
        'telefono', 
        'email', 
        'domicilio1', 
        'domicilio2', 
        'domicilio3', 
        'pais', 
        'codigoPostal', 
    ];
}