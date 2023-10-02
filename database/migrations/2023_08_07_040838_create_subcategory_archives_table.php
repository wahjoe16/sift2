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
        Schema::create('subcategory_archives', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->bigInteger('section_id')->unsigned();
            $table->bigInteger('category_archive_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections');
            $table->foreign('category_archive_id')->references('id')->on('category_archives');
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
        Schema::dropIfExists('subcategory_archives');
    }
};
