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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('subcategory_id')->unsigned();
            $table->bigInteger('tingkat_id')->unsigned()->nullable();
            $table->bigInteger('prestasi_id')->unsigned()->nullable();
            $table->bigInteger('jabatan_id')->unsigned()->nullable();
            $table->string('nama_kegiatan');
            $table->date('tanggal');
            $table->string('bukti_fisik');
            $table->integer('point')->nullable();
            $table->float('total_point', 8,2)->nullable();
            $table->tinyInteger('status_skkft')->default(0);
            $table->tinyInteger('status_skpi')->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('category_skkft');
            $table->foreign('subcategory_id')->references('id')->on('subcategory_skkft');
            $table->foreign('tingkat_id')->references('id')->on('tingkat');
            $table->foreign('prestasi_id')->references('id')->on('prestasi_skkft');
            $table->foreign('jabatan_id')->references('id')->on('jabatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kegiatan');
    }
};
