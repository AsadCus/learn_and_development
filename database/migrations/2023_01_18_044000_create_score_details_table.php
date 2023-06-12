<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('score_id');
            $table->foreign('score_id')->references('id')->on('scores');
            $table->unsignedBigInteger('form_id');
            $table->foreign('form_id')->references('id')->on('score_forms');
            $table->unsignedBigInteger('value_id');
            $table->foreign('value_id')->references('id')->on('score_values');
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
        Schema::dropIfExists('score_details');
    }
};
