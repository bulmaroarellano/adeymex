<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToMercanciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mercancias', function (Blueprint $table) {
            $table
                ->foreign('pais_id')
                ->references('id')
                ->on('paises');

            $table
                ->foreign('moneda_id')
                ->references('id')
                ->on('monedas');

            $table
                ->foreign('unidad_id')
                ->references('id')
                ->on('unidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mercancias', function (Blueprint $table) {
            $table->dropForeign(['pais_id']);
            $table->dropForeign(['moneda_id']);
            $table->dropForeign(['unidad_id']);
        });
    }
}
