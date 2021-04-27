<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinatariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinatarios', function (Blueprint $table) {
            $table->id();
            $table->string('sucursal');
            $table->string('nombre');
            $table->string('apellidoP');
            $table->string('apellidoM')->nullable();
            $table->string('empresa')->nullable();
            $table->string('telefono');
            $table->string('email');
            $table->string('domicilio1');
            $table->string('domicilio2')->nullable();
            $table->string('domicilio3')->nullable();
            $table->string('pais');
            $table->string('codigoPostal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('destinatarios');
    }
}
