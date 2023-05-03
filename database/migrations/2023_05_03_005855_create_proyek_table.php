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
        Schema::create('proyek', function (Blueprint $table) {
            $table->increments('id_proyek');
            $table->date('tgl');
            $table->string('kode_proyek');
            $table->string('nm_proyek');
            $table->string('manager_proyek');
            $table->enum('status', ['berjalan', 'selesai']);
            $table->date('tgl_estimasi');
            $table->double('biaya_estimasi');
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
        Schema::dropIfExists('proyek');
    }
};
