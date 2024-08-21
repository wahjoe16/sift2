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
        Schema::table('skpi', function (Blueprint $table) {
            $table->enum('akreditasi_fakultas', [
                'Unggul', 'Baik Sekali', 'Baik', 'Tidak Terakreditasi'
            ])->nullable()->after('no_ijazah');
            $table->enum('akreditasi_prodi', [
                'Unggul', 'Baik Sekali', 'Baik', 'Tidak Terakreditasi'
            ])->nullable()->after('akreditasi_fakultas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skpi', function (Blueprint $table) {
            $table->dropColumn('akreditasi_fakultas');
            $table->dropColumn('akreditasi_prodi');
        });
    }
};
