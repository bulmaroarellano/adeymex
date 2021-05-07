<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pais extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = ['nombre', 'codigo', 'moneda_id'];

    protected $searchableFields = ['*'];

    protected $table = 'paises';

    public function sucursals()
    {
        return $this->hasMany(Sucursal::class);
    }

    public function remitentes()
    {
        return $this->hasMany(Remitente::class);
    }

    public function destinatarios()
    {
        return $this->hasMany(Destinatario::class);
    }

    public function mercancias()
    {
        return $this->hasMany(Mercancia::class);
    }

    public function moneda()
    {
        return $this->belongsTo(Moneda::class);
    }
}
