<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_sosial_alumni', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('link_linkedin', 150)->nullable();
            $table->string('link_instagram', 150)->nullable();
            $table->string('link_twitter', 150)->nullable();
            $table->string('link_facebook', 150)->nullable();
            $table->string('link_youtube', 150)->nullable();
            $table->string('link_website', 150)->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('media_sosial_alumni');
    }
};
