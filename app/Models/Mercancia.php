<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mercancia extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'producto',
        'producto_ingles',
        'clave_internacional',
        'costo',
        'medida',
        'peso',
        'pais_id',
        'moneda_id',
        'unidad_id',
    ];

    protected $searchableFields = ['*'];

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

    public function moneda()
    {
        return $this->belongsTo(Moneda::class);
    }

    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }
}
