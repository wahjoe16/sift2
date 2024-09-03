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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('npm', 11);
            $table->string('nama_mahasiswa', 50);
            $table->string('password', 100);
            $table->string('email', 50)->nullable();
            $table->string('hp', 15)->nullable();
            $table->string('prodi', 50)->nullable();
            $table->string('angkatan', 4)->nullable();
            $table->string('foto', 50)->nullable();
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
        Schema::dropIfExists('mahasiswa');
    }
};
