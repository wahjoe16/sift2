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
        Schema::create('jabatan_profesi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('profesi_id')->unsigned();
            $table->string('nama_jabatan', 150);
            $table->timestamps();

            $table->foreign('profesi_id')->references('id')->on('profesi_alumni');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jabatan_profesi');
    }
};
