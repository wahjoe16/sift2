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
        Schema::create('jobs_alumni', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->year('tahun_masuk_bekerja')->nullable();
            $table->year('tahun_berhenti_bekerja')->nullable();
            $table->enum('jenis_pekerjaan', ['ASN/BUMN', 'TNI', 'POLRI', 'Swasta', 'Multinasional', 'Berwirausaha', 'Tidak Bekerja'])->nullable();
            $table->string('posisi')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('lokasi_perusahaan')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs_alumni');
    }
};
