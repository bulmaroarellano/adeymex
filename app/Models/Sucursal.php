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
        'codigo_postal',
        'domicilio1',
        'domicilo2',
        'domicilio3',
        'pais_id',
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
        return $this->hasOne(Encargado::class);
    }
}
