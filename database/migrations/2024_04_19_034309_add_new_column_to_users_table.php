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
            $table->enum('class_pendidikan', ['D3','S1','S2','S3'])->nullable()->after('tipe_dosen');
            $table->enum('class_jabfung',['Tenaga Pengajar', 'Asisten Ahli', 'Lektor', 'Lektor Kepala', 'Guru Besar/Professor'])->nullable()->after('class_pendidikan');
            $table->enum('kelompok_keahlian', 
            ['Geologi EksPlorasi','Tambang Umum','Pengolahan Bahan Galian',
             'Keahlian Ergonomi dan Rekayasa Kerja', 'Manajemen Industri', 'Sistem Industri dan Tekno-Ekonomi','Sistem Manufaktur',
             'Kota','Transportasi','Lingkungan','Pariwisata','Rekayasa Pedesaan',
            ])->nullable()->after('class_jabfung');
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
            $table->dropColumn('class_pendidikan');
            $table->dropColumn('class_jabfung');
            $table->dropColumn('kelompok_keahlian');
        });
    }
};
