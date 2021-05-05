<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuministrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suministros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nombre');
            $table->text('costo');
            $table->text('precio_publico');
            $table->unsignedBigInteger('sucursal_id');
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
        Schema::dropIfExists('suministros');
    }
}
