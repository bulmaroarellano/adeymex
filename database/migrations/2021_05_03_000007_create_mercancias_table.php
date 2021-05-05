<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMercanciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mercancias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('producto');
            $table->text('producto_ingles');
            $table->text('clave_internacional')->nullable();
            $table->text('costo')->nullable();
            $table->text('medida')->nullable();
            $table->text('peso');
            $table->unsignedBigInteger('pais_id');
            $table->unsignedBigInteger('moneda_id');
            $table->unsignedBigInteger('unidad_id');
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
        Schema::dropIfExists('mercancias');
    }
}
