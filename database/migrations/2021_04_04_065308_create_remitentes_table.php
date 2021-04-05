<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//* persona que envia el paquete 

class CreateRemitentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remitentes', function (Blueprint $table) {
            $table->id();
            $table-> string('nombre_remitente');
            $table-> string('direccion_remitente');
            $table-> string('ciudad_remitente');
            $table-> string('telefono_remitente');
            $table-> string('cp_remitente');
            $table-> string('email_remitente');
            $table->integer('peso_remitente');
            $table->integer('largo_remitente');
            $table->integer('ancho_remitente');
            $table->integer('altura_remitente');
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
        Schema::dropIfExists('remitentes');
    }
}
