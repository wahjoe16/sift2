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
            $table->string('bidang_pekerjaan', 150)->nullable()->after('jenis_pekerjaan');
            $table->bigInteger('posisi_id')->unsigned()->nullable()->after('bidang_pekerjaan');
            $table->bigInteger('subposisi_id')->unsigned()->nullable()->after('posisi_id');

            $table->foreign('posisi_id')->references('id')->on('posisi');
            $table->foreign('subposisi_id')->references('id')->on('sub_posisi');
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
            $table->dropForeign(['posisi_id','subposisi_id']);
            $table->dropColumn('bidang_pekerjaan');
            $table->dropColumn('posisi_id');
            $table->dropColumn('subposisi_id');
        });
    }
};
