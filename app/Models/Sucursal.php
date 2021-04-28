<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sucursal extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "sucursales";

    protected $fillable = [
        'sucursal',
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
