<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadingTotalLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reading_total_lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('level_lesson_id')->unsigned();
            $table->integer('type_lesson_id')->unsigned();
            $table->integer('type_question_id');
            $table->integer('total_lessons')->unsigned();
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
        Schema::dropIfExists('reading_total_lessons');
    }
}
