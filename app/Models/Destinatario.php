<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinatario extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre_destinatario",
        "direccion_destinatario",
        "ciudad_destinatario",
        "telefono_destinatario",
        "cp_destinatario",
    ]; 

    
}
