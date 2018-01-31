<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoryEnglishGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('story_english_genres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('genre')->unique();
            $table->text('introduction')->nullable();
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
        Schema::dropIfExists('story_english_genres');
    }
}
