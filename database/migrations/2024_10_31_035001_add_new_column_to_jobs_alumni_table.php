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
        Schema::table('jobs_alumni', function (Blueprint $table) {
            $table->bigInteger('profesi_id')->unsigned()->nullable()->after('tahun_berhenti_bekerja');
            $table->bigInteger('jabatan_id')->unsigned()->nullable()->after('profesi_id');
            $table->foreign('profesi_id')->references('id')->on('profesi_alumni');
            $table->foreign('jabatan_id')->references('id')->on('jabatan_profesi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs_alumni', function (Blueprint $table) {
            $table->dropColumn('profesi_id');
            $table->dropColumn('jabatan_id');
        });
    }
};
