<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSucursalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nombre');
            $table->text('telefono');
            $table->text('email');
            $table->unsignedBigInteger('encargado_id');
            $table->text('codigo_postal');
            $table->unsignedBigInteger('pais_id');
            $table->text('domicilio1');
            $table->text('domicilo2')->nullable();
            $table->text('domicilio3')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('sucursales');
    }
}
