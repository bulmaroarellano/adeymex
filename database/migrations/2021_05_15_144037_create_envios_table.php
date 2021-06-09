<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnviosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envios', function (Blueprint $table) {
            $table->id();
            $table->text('paqueteria');
            $table->text('tipo_servicio');
            $table->text('tipo_paquete');
            $table->text('largo_paquete');
            $table->text('ancho_paquete');
            $table->text('alto_paquete');
            $table->text('peso_paquete');
            $table->text('status_envio')->default('ESPERANDO RECOLECCION');
            $table->text('numero_guia');
            $table->text('url_guia');
            
            $table->text('origen_cp_envio');
            $table->text('destino_cp_envio');
            $table->unsignedBigInteger('sucursal_id');
            $table->unsignedBigInteger('remitente_id');
            $table->unsignedBigInteger('destinatario_id'); 
            $table->unsignedBigInteger('pago_id')->nullable(); 
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('envios');
    }
}
