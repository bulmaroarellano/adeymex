<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guia extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'master_guia', 
        'slave_guia', 
        'url_slave_guia', 
    ];

    protected $table = 'guias';
}
