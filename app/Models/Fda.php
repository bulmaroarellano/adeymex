<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fda extends Model
{
    use HasFactory;
    use SoftDeletes;

    
    protected $fillable = [
        'envio_id', 
        'url_fda', 
    ];


    public function envio()
    {
        return $this->belongsTo(Envio::class);
    }


}
