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
        Schema::create('tb_gudang', function (Blueprint $table) {
            $table->integer('id_gudang', true);
            $table->string('kd_gudang', 10);
            $table->string('nm_gudang', 100);
            $table->integer('id_departemen');
            $table->integer('kategori_id');
            $table->string('admin', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_gudang');
    }
};
