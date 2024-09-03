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
        Schema::create('kegiatan_old', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('mahasiswa_id')->unsigned();
            $table->bigInteger('kategori_id')->unsigned();
            $table->bigInteger('subkategori_id')->unsigned();
            $table->bigInteger('grade_id')->unsigned()->nullable();
            $table->bigInteger('prestasi_id')->unsigned()->nullable();
            $table->bigInteger('jabatan_id')->unsigned()->nullable();
            $table->text('nama_kegiatan');
            $table->date('tanggal');
            $table->date('tanggal_berakhir')->nullable();
            $table->string('sertifikat')->nullable();
            $table->integer('poin')->nullable();
            $table->integer('status')->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa');
            $table->foreign('kategori_id')->references('id')->on('category_skkft');
            $table->foreign('subkategori_id')->references('id')->on('subcategory_skkft');
            $table->foreign('grade_id')->references('id')->on('tingkat');
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
        Schema::dropIfExists('kegiatan_old');
    }
};
