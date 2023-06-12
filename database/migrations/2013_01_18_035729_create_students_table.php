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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institute_id')->nullable();
            $table->foreign('institute_id')->references('id')->on('institutes');
            $table->string('major')->nullable();
            $table->float('ipk')->nullable();
            $table->text('address')->nullable();
            $table->string('nik')->nullable();
            $table->string('nim')->nullable();
            $table->string('phone');
            $table->string('emergency_contact')->nullable();
            $table->string('division');
            $table->string('department');
            $table->string('job_role');
            $table->string('cv')->comment('file')->nullable();
            $table->string('start_date');
            $table->string('end_date');
            $table->string('status');
            $table->unsignedBigInteger('supervisor_id');
            $table->foreign('supervisor_id')->references('id')->on('supervisors');
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
        Schema::dropIfExists('students');
    }
};
