<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostDownloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('host_downloads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60)->unique();
            $table->text('logo');
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
        Schema::dropIfExists('host_downloads');
    }
}
