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
        Schema::table('daftar_sidang', function (Blueprint $table) {
            $table->bigInteger('dosen3_id')->nullable()->after('dosen2_id')->unsigned();
            $table->bigInteger('dosen4_id')->nullable()->after('dosen3_id')->unsigned();
            $table->foreign('dosen3_id')->references('id')->on('users');
            $table->foreign('dosen4_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daftar_sidang', function (Blueprint $table) {
            $table->dropColumn('dosen3_id');
            $table->dropColumn('dosen4_id');
        });
    }
};
