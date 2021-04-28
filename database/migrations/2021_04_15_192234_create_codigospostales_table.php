<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodigospostalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigospostales', function (Blueprint $table) {
            $table->id();
            $table->string('codigoPostal');
            $table->string('direccion');
            $table->string('ciudad');
            $table->string('codigoEstado');
            $table->string('municipio');
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
        Schema::dropIfExists('codigospostales');
        Schema::table('codigospostales', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
