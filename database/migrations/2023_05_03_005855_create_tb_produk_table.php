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
        Schema::create('tb_produk', function (Blueprint $table) {
            $table->integer('id_produk', true);
            $table->integer('kd_produk');
            $table->string('nm_produk', 100);
            $table->integer('kategori_id');
            $table->integer('gudang_id');
            $table->integer('satuan_id');
            $table->integer('departemen_id');
            $table->enum('kontrol_stok', ['T', 'Y'])->nullable();
            $table->string('img', 200);
            $table->date('tgl');
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
        Schema::dropIfExists('tb_produk');
    }
};
