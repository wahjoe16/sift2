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
        Schema::create('sub_posisi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('posisi_id')->unsigned();
            $table->string('nama_posisi', 100);
            $table->timestamps();

            $table->foreign('posisi_id')->references('id')->on('posisi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_posisi');
    }
};
