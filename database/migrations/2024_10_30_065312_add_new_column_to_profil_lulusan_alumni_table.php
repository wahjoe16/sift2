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
        Schema::table('profil_lulusan_alumni', function (Blueprint $table) {
            $table->string('perguruan_tinggi', 200)->after('npm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profil_lulusan_alumni', function (Blueprint $table) {
            $table->dropColumn('perguruan_tinggi');
        });
    }
};
