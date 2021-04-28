<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mercancia extends Model
{
    use HasFactory;
    use SoftDeletes;

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
