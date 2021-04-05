<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remitente extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre_remitente",
        "direccion_remitente",
        "ciudad_remitente",
        "telefono_remitente",
        "cp_remitente",
        "email_remitente",
        "peso_remitente",
        "largo_remitente",
        "ancho_remitente",
        "altura_remitente",
    ];
}
