<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = "sucursales";

    protected $fillable = [
        'descripcion',
        'telefono',
        'email',
        'encargado',
        'domicilio1',
        'domicilio2',
        'domicilio3',
        'pais',
        'codigoPostal',
    ];

}
