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
        Schema::table('archives', function (Blueprint $table) {
            $table->bigInteger('tahun_ajaran_id')->unsigned();
            $table->bigInteger('semester_id')->unsigned();
            $table->foreign('tahun_ajaran_id')->references('id')->on('tahun_ajaran');
            $table->foreign('semester_id')->references('id')->on('semester');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('archives', function (Blueprint $table) {
            $table->dropColumn('tahun_ajaran_id');
            $table->dropColumn('semester_id');
        });
    }
};
