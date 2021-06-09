<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zips', function (Blueprint $table) {
            $table->id();
            $table->text('postal_code');
            $table->text('country_code');
            $table->text('place_name');
            $table->text('admin_name1');
            $table->text('code_name1');
            $table->text('admin_name2');
            $table->text('code_name2');
            $table->text('admin_name3');
            $table->text('code_name3');
            $table->text('latitude');
            $table->text('longitude');
            $table->text('accuracy');
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
        Schema::dropIfExists('zips');
    }
}
