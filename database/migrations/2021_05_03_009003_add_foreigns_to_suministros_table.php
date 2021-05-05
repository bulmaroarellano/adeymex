<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToSuministrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suministros', function (Blueprint $table) {
            $table
                ->foreign('sucursal_id')
                ->references('id')
                ->on('sucursales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suministros', function (Blueprint $table) {
            $table->dropForeign(['sucursal_id']);
        });
    }
}
