<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CodigoPostal extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'codigospostales';

    protected $fillable = [
        'codigoPostal',
        'direccion',
        'ciudad',
        'codigoEstado',
        'municipio',
    ];
}