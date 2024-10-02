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
        Schema::table('alumni', function (Blueprint $table) {
            $table->tinyInteger('allow_view_alamat')->after('alamat')->default(0);
            $table->string('no_hp', 15)->after('allow_view_alamat')->nullable();
            $table->tinyInteger('allow_view_no_hp')->after('no_hp')->default(0);
            $table->string('kompetensi', 100)->after('allow_view_no_hp')->nullable();
            $table->string('sertifikat_kompetensi', 100)->after('kompetensi')->nullable();
            $table->string('keahlian', 100)->after('sertifikat_kompetensi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alumni', function (Blueprint $table) {
            $table->dropColumn('allow_view_alamat');
            $table->dropColumn('no_hp');
            $table->dropColumn('allow_view_no_hp');
            $table->dropColumn('kompetensi');
            $table->dropColumn('sertifikat_kompetensi');
            $table->dropColumn('keahlian');
        });
    }
};
