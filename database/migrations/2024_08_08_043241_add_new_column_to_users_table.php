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
        Schema::table('users', function (Blueprint $table) {
            $table->string('tahun_lulus', 5)->nullable()->after('program_studi');
            $table->string('alamat_kerja')->nullable()->after('tahun_lulus');
            $table->string('pekerjaan_sekarang')->nullable()->after('alamat_kerja');
            $table->string('perusahaan_sekarang')->nullable()->after('pekerjaan_sekarang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('tahun_lulus');
            $table->dropColumn('alamat_kerja');
            $table->dropColumn('pekerjaan_sekarang');
            $table->dropColumn('perusahaan_sekarang');
        });
    }
};
