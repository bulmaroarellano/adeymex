<?php

namespace App\Models;

use App\Models\Scopes\Searchable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pago extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'metodo_pago', 
        'referencia_pago', 
        'costo_sucursal_envio', 
        'costo_publico_envio', 
        'cargos_envio', 
        'impuestos_envio', 
        'cargo_logistica_interna', 
        'suministros_precio_total',
        'precio_total_sucursal'

    ];
    protected $searchableFields = ['*'];


    public function envios()
    {
        return $this->hasMany(Envio::class);
    }

    public function insumos()
    {
        return $this->hasMany(Insumo::class);
    }



}
