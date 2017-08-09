<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->char('photoable_type', 16); // photo relation obj type
            $table->integer('photoable_id');    // photo relation obj id
            $table->string('title', 128);       // photo title
            $table->string('url', 128);         // photo url
            $table->char('url_md5', 32);        // photo url md5
            $table->string('path', 64);         // photo local path
            $table->integer('seq')->default(1); // photo seq
            $table->index(['photoable_type', 'photoable_id'], 'photoable');
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
        Schema::drop('photos');
    }
}
