<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Moneda extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = ['nombre', 'codigo', 'simbolo'];

    protected $searchableFields = ['*'];

    public function mercancias()
    {
        return $this->hasMany(Mercancia::class);
    }

    public function paises()
    {
        return $this->hasMany(Pais::class);
    }
}
