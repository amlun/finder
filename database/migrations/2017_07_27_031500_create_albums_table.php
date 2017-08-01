<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('girl_id');  // girl id
            $table->string('cover', 128);// album cover
            $table->string('title', 128);// album title
            $table->string('link', 128); // album link url
            $table->char('link_md5', 32);// album link url md5
            $table->index('girl_id');
            $table->unique('link_md5');
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
        Schema::drop('albums');
    }
}
