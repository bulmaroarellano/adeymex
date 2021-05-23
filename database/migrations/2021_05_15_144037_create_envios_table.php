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
            $table->text('tipo_envio');
            $table->text('numero_guia');
            $table->text('status_pago')->nullable();
            $table->text('status_recoleccion')->nullable();
            $table->text('remitente_cp_envio');
            $table->text('destinatario_cp_envio');
            $table->unsignedBigInteger('sucursal_id');
            $table->unsignedBigInteger('remitente_id');
            $table->unsignedBigInteger('destinatario_id');
            
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
