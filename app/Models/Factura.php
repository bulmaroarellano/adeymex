<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Factura extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;


    protected $fillable = [
        'paqueteria', 
        'folio', 
        'fecha', 
        'precio_total', 

    ];

    protected $casts = [
        'fecha' => 'datetime:Y-m-d',
    ];

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }




}
