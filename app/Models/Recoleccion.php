<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recoleccion extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;


    protected $fillable = [
        'sucursal_id', 
        'paqueteria', 
        'status', 
        'fecha_recoleccion', 
        'folio_recoleccion',
    ];

    protected $table = 'recoleccions';

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

}
