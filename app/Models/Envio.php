<?php

namespace App\Models;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Envio extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;

    protected $fillable = [
        'tipo_servicio', 
        'tipo_paquete', 
        'largo_paquete', 
        'ancho_paquete', 
        'alto_paquete', 
        'peso_paquete', 
        'numero_guia', 
        'url_guia', 
         
        'origen_cp_envio', 
        'destino_cp_envio', 
        'sucursal_id', 
        'remitente_id', 
        'destinatario_id',   
        'destinatario_id',   
        'pago_id',   

    ];

    protected $table = 'envios';
    protected $searchableFields = ['*'];

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
    
    public function remitente()
    {    
        return $this->belongsTo(Remitente::class);
    }

    public function destinatario()
    {    
        return $this->belongsTo(Destinatario::class);
    }

    public function pago()
    {    
        return $this->belongsTo(Pago::class);
    }



}
