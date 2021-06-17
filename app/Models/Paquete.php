<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paquete extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'numero_guia', 
        'largo_paquete', 
        'ancho_paquete', 
        'alto_paquete', 
        'peso_paquete', 
    ];

    protected $table = 'paquetes';
    




}
