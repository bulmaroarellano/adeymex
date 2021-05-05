<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Remitente extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'telefono',
        'email',
        'cliente_id',
        'empresa_id',
        'domicilio1',
        'domicilio2',
        'domicilio3',
        'codigo_postal',
        'sucursal_id',
        'pais_id',
    ];

    protected $searchableFields = ['*'];

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
