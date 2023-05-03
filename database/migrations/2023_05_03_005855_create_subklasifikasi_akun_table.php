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
        Schema::create('subklasifikasi_akun', function (Blueprint $table) {
            $table->increments('id_subklasifikasi_akun');
            $table->string('nm_subklasifikasi');
            $table->integer('kode_sub');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subklasifikasi_akun');
    }
};
