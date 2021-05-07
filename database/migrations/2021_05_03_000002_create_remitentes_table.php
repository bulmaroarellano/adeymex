<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->text('nombre');
            $table->text('apellido_paterno');
            $table->text('apellido_materno')->nullable();
            $table->text('telefono');
            $table->string('email')->nullable();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->text('domicilio1');
            $table->text('domicilio2')->nullable();
            $table->text('domicilio3')->nullable();
            $table->text('codigo_postal');
            $table->unsignedBigInteger('sucursal_id');
            $table->unsignedBigInteger('pais_id');

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
        Schema::dropIfExists('remitentes');
    }
}
