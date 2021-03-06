<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CodigoPostal extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'codigo_postal',
        'ciudad',
        'codigo_estado',
        'municipio',
        'direccion',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'codigo_postales';
}
