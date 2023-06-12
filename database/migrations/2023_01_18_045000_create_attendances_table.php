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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('clock_in');
            $table->string('clock_out')->nullable();
            $table->text('activity')->nullable();
            $table->string('attachment')->nullable();
            $table->string('working_hour')->nullable();
            $table->text('notes')->nullable();
            $table->enum('work_type', ['WFO', 'WFH']);
            $table->enum('attendance_type', ['pending', 'present', 'reject', 'off']);
            $table->string('status');
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
        Schema::dropIfExists('attendances');
    }
};
