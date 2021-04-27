<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mercancia extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto',
        'productoIngles',
        'claveInternacional',
        'costo',
        'moneda',
        'medida',
        'unidadMedida',
        'pais',
        'peso',
    ];
}
