<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Suministro extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = ['nombre', 'costo', 'precio_publico', 'sucursal_id'];

    protected $searchableFields = ['*'];

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
}
