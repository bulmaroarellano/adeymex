<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sucursal extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'encargado_id',
        'codigo_postal',
        'pais_id',
        'domicilio1',
        'domicilo2',
        'domicilio3',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'sucursales';

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

    public function remitentes()
    {
        return $this->hasMany(Remitente::class);
    }

    public function destinatarios()
    {
        return $this->hasMany(Destinatario::class);
    }

    public function suministros()
    {
        return $this->hasMany(Suministro::class);
    }

    public function encargado()
    {
        return $this->belongsTo(Encargado::class);
    }
}
