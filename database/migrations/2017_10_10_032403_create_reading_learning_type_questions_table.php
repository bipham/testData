<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadingLearningTypeQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *, $, $
     * @return void
     */
    public function up()
    {
        Schema::create('reading_learning_type_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type_question_id');
            $table->integer('level_user_id')->unsigned();
            $table->string('title');
            $table->integer('order_lesson');
            $table->string('icon')->default('fa-cog');
            $table->tinyInteger('view_layout')->default(1);
            $table->text('content_section')->nullable();
            $table->text('left_content')->nullable();
            $table->text('right_content')->nullable();
            $table->text('content_answer_quiz')->nullable();
            $table->text('content_highlight')->nullable();
            $table->integer('total_questions');
            $table->integer('admin_responsibility')->unsigned();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('reading_learning_type_questions');
    }
}
