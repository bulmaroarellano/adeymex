<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gasto extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;


    protected $fillable = [

        'tipo_gasto', 
        'monto_gasto', 
        'url_comprobante', 
        'fecha', 
        'usuario_id', 
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }



    
}
