<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodigoPostalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigo_postales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('codigo_postal');
            $table->text('ciudad');
            $table->text('codigo_estado');
            $table->text('municipio');
            $table->text('direccion');

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
        Schema::dropIfExists('codigo_postales');
    }
}
