<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mensajeria extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'mensajeria', 
        'logo', 
    ];
}
