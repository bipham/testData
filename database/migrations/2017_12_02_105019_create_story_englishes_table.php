<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoryEnglishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('story_englishes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('image_cover')->nullable();
            $table->text('description')->nullable();
            $table->string('author_id');
            $table->tinyInteger('level_story_id');
            $table->tinyInteger('genre_id');
            $table->tinyInteger('length_id');
            $table->integer('viewed')->default(0);
            $table->boolean('status')->default(1);
            $table->integer('admin_responsibility')->unsigned();
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
        Schema::dropIfExists('story_englishes');
    }
}
