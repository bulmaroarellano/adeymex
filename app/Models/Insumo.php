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
        'suministro_id', 
        'cantidad_suministro', 
        'costo_total_suministro', 
    ];

    protected $table = 'insumos';

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    public function suministro()
    {
        return $this->belongsTo(Suministro::class);
    }


}
