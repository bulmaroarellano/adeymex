<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = ['nombre', 'tipo_cliente_id'];

    protected $searchableFields = ['*'];

    public function remitentes()
    {
        return $this->hasMany(Remitente::class);
    }

    public function tipoCliente()
    {
        return $this->belongsTo(TipoCliente::class);
    }
}
