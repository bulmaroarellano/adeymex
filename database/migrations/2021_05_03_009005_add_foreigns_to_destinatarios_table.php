<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToDestinatariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('destinatarios', function (Blueprint $table) {
            $table
                ->foreign('empresa_id')
                ->references('id')
                ->on('empresas');

            $table
                ->foreign('sucursal_id')
                ->references('id')
                ->on('sucursales');

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
        Schema::table('destinatarios', function (Blueprint $table) {
            $table->dropForeign(['empresa_id']);
            $table->dropForeign(['sucursal_id']);
            $table->dropForeign(['pais_id']);
        });
    }
}
