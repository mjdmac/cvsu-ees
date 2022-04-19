<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('sched_code');
            $table->foreignId('exam_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreignId('college_id')->references('id')->on('questions')->onDelete('cascade');
            $table->date('sched_date');
            $table->time('sched_time');
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
        Schema::dropIfExists('exam_schedules');
    }
}
