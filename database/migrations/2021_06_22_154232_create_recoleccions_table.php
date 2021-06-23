<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecoleccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recoleccions', function (Blueprint $table) {
            $table->id();
            $table->text('sucursal_id');
            $table->text('paqueteria');
            $table->text('status')->default('Generado');
            $table->date('fecha_recoleccion');
            $table->text('folio_recoleccion');

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
        Schema::dropIfExists('recoleccions');
    }
}
