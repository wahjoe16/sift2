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
        Schema::create('profil_lulusan_alumni', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->enum('jenjang', ['S1', 'S2', 'S3', 'Profesi'])->nullable();
            $table->string('angkatan', 5)->nullable();
            $table->string('tahun_lulus', 5)->nullable();
            $table->string('npm', 15)->nullable();
            $table->enum('program_studi', [
                'Teknik Pertambangan',
                'Teknik Industri',
                'Perencanaan Wilayah dan Kota',
                'Program Profesi Insinyur',
                'Magister Perencanaan Wilayah dan Kota'
            ]);
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
        Schema::dropIfExists('profil_lulusan_alumni');
    }
};
