<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSepomexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sepomexes', function (Blueprint $table) {
            $table->id();
            $table->text('d_codigo')->nullable();
            $table->text('d_asenta')->nullable();
            $table->text('d_tipo_asenta')->nullable();
            $table->text('D_mnpio')->nullable();
            $table->text('d_estado')->nullable();
            $table->text('d_ciudad')->nullable();
            $table->text('d_CP')->nullable();
            $table->text('c_estado')->nullable();
            $table->text('c_oficina')->nullable();
            $table->text('c_CP')->nullable();
            $table->text('c_tipo_asenta')->nullable();
            $table->text('c_mnpio')->nullable();
            $table->text('id_asenta_cpcons')->nullable();
            $table->text('d_zona')->nullable();
            $table->text('c_cve_ciudad')->nullable();
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
        Schema::dropIfExists('sepomexes');
    }
}
