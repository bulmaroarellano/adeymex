<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empresa extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = ['nombre', 'descripcion'];

    protected $searchableFields = ['*'];

    public function destinatarios()
    {
        return $this->hasMany(Destinatario::class);
    }

    public function remitentes()
    {
        return $this->hasMany(Remitente::class);
    }
}
