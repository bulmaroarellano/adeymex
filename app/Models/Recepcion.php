<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepcion extends Model
{
    use HasFactory;

    protected $fillable = [
        'paqueteria', 
        'numero_paquetes', 
        'fecha', 
        'numero_guia', 
        'precio', 
        'observaciones', 
    ];

    protected $casts = [
        'fecha' => 'datetime:Y-m-d',
    ];
}
