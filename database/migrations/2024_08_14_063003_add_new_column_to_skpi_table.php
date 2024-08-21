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
            $table->string('no_skpi', 30)->nullable()->after('user_id');
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->date('tanggal_masuk')->nullable()->after('no_skpi');
            $table->date('tanggal_lulus')->nullable()->after('tanggal_masuk');
            $table->string('lama_studi', 20)->nullable()->after('tanggal_lulus');
            $table->string('no_ijazah', 20)->nullable()->after('lama_studi');
            
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
            $table->dropColumn('no_skpi');
            $table->dropColumn('tempat_lahir');
            $table->dropColumn('tanggal_lahir');
            $table->dropColumn('tanggal_masuk');
            $table->dropColumn('tanggal_lulus');
            $table->dropColumn('lama_studi');
            $table->dropColumn('no_ijazah');
            $table->dropColumn('gelar');
        });
    }
};
