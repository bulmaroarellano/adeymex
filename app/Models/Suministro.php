<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suministro extends Model
{
    use HasFactory;
    protected $fillable = [
        'sucursal', 
        'producto', 
        'costo', 
        'precioPublico', 

    ];
}
