<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('producto');
            $table->string('productoIngles');
            $table->string('claveInternacional');
            $table->string('costo');
            $table->string('moneda');
            $table->decimal('medida');
            $table->string('unidadMedida');
            $table->string('pais');
            $table->decimal('peso');
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
