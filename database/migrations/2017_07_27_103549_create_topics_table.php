<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('girl_id');
            $table->string('title', 128);// topic title
            $table->string('cover', 64); // topic cover
            $table->text('content');     // topic content
            $table->string('url', 128);  // topic url
            $table->char('url_md5', 32); // topic url md5
            $table->index('girl_id');
            $table->unique('url_md5');
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
        Schema::drop('topics');
    }
}
