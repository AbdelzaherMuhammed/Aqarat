<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAqarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aqars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bu_name');
            $table->string('bu_price');
            $table->string('rooms');
            $table->tinyInteger('bu_rent');
            $table->string('bu_square');
            $table->string('bu_meta');
            $table->tinyInteger('bu_type');
            $table->string('bu_small_disc');
            $table->string('bu_longitude');
            $table->string('bu_latitude');
            $table->longText('bu_large_disc');
            $table->tinyInteger('bu_status');
            $table->tinyInteger('rooms');
            $table->tinyInteger('bu_place');
            $table->string('month');

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
        Schema::dropIfExists('aqars');
    }
}
