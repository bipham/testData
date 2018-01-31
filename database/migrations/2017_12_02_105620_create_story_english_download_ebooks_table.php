<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoryEnglishDownloadEbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('story_english_download_ebooks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chap_id');
            $table->integer('host_id');
            $table->text('link');
            $table->string('file_type');
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
        Schema::dropIfExists('story_english_download_ebooks');
    }
}
