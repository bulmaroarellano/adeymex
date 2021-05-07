<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoCliente extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['tipo_cliente'];

    protected $searchableFields = ['*'];

    protected $table = 'tipo_clientes';

    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }
}
