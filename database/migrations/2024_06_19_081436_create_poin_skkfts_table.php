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
        Schema::create('poin_skkft', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('subcategory_id')->unsigned();
            $table->bigInteger('tingkat_id')->unsigned()->nullable();
            $table->bigInteger('prestasi_id')->unsigned()->nullable();
            $table->bigInteger('jabatan_id')->unsigned()->nullable();
            $table->integer('point');
            $table->foreign('category_id')->references('id')->on('category_skkft');
            $table->foreign('subcategory_id')->references('id')->on('subcategory_skkft');
            $table->foreign('tingkat_id')->references('id')->on('tingkat');
            $table->foreign('prestasi_id')->references('id')->on('prestasi_skkft');
            $table->foreign('jabatan_id')->references('id')->on('jabatan');
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
        Schema::dropIfExists('poin_skkft');
    }
};
