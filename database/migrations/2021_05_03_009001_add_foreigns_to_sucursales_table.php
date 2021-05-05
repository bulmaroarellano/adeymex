<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToSucursalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sucursales', function (Blueprint $table) {
            $table
                ->foreign('encargado_id')
                ->references('id')
                ->on('encargados');

            $table
                ->foreign('pais_id')
                ->references('id')
                ->on('paises');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sucursales', function (Blueprint $table) {
            $table->dropForeign(['encargado_id']);
            $table->dropForeign(['pais_id']);
        });
    }
}
