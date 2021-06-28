<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Insumo extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;

    protected $fillable = [
        'pago_id', 
        'suministro_id', 
        'suministro_cantidad', 
    ];

    protected $table = 'insumos';

    public function pago()
    {
        return $this->belongsTo(Pago::class);
    }

    public function suministro()
    {
        return $this->belongsTo(Suministro::class);
    }

    


}
