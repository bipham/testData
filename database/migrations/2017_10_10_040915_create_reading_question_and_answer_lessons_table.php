<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadingQuestionAndAnswerLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reading_question_and_answer_lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_lesson_id');
            $table->integer('question_custom_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('reply_comment_id')->unsigned()->default(0);
            $table->text('content_cmt');
            $table->boolean('status')->default(1);
            $table->boolean('private')->default(1);
//            $table->foreign('question_id')->references('id')->on('reading_questions')->onDelete('cascade');
//            $table->foreign('user_id')->references('id')->on('reading_users')->onDelete('cascade');
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
        Schema::dropIfExists('reading_question_and_answer_lessons');
    }
}
