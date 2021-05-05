<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unidad extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = ['unidad_medida', 'abreviacion'];

    protected $searchableFields = ['*'];

    protected $table = 'unidades';

    public function mercancias()
    {
        return $this->hasMany(Mercancia::class);
    }
}
