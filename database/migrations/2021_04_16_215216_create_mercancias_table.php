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
            $table->string('productoIngles')->nullable();
            $table->string('claveInternacional');
            $table->string('costo');
            $table->string('moneda')->nullable();
            $table->decimal('medida')->nullable();
            $table->string('unidadMedida')->nullable();
            $table->string('pais')->nullable();
            $table->decimal('peso')->nullable();
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
        Schema::table('mercancias', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
