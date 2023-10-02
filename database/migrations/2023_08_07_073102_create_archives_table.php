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
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->string('file', 100);
            $table->bigInteger('section_id')->unsigned();
            $table->bigInteger('category_archive_id')->unsigned()->nullable();
            $table->bigInteger('subcategory_archive_id')->unsigned()->nullable();
            $table->foreign('section_id')->references('id')->on('sections');
            $table->foreign('category_archive_id')->references('id')->on('category_archives');
            $table->foreign('subcategory_archive_id')->references('id')->on('subcategory_archives');
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
        Schema::dropIfExists('archives');
    }
};
