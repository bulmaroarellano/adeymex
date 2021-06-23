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
            $table->text('status_envio')->default('GUIA GENERADA');
            $table->text('status_recoleccion')->default('SIN RECOLECCION');
            $table->text('master_guia');
            $table->text('recoleccion_guia')->default('N/A');
            $table->text('url_master_guia');
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
