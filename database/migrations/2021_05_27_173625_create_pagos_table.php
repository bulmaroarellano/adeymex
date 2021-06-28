<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->text('metodo_pago');
            $table->text('referencia_pago');
            $table->text('costo_sucursal_envio');
            $table->text('costo_publico_envio')->nullable();
            $table->text('cargos_envio');
            $table->text('impuestos_envio');
            $table->text('cargo_logistica_interna');
            $table->text('suministros_precio_total');
            $table->text('precio_total_sucursal');

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
        Schema::dropIfExists('pagos');
    }
}
