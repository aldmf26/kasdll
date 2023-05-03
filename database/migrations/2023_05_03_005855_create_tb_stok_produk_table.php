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
        Schema::create('tb_stok_produk', function (Blueprint $table) {
            $table->integer('id_stok_produk', true);
            $table->integer('id_produk');
            $table->integer('urutan');
            $table->string('no_nota', 100);
            $table->date('tgl');
            $table->enum('jenis', ['draft', 'selesai']);
            $table->set('status', ['masuk', 'keluar', 'opname']);
            $table->double('jml_sebelumnya')->default(0);
            $table->double('jml_sesudahnya')->default(0);
            $table->double('debit')->default(0);
            $table->double('kredit')->default(0);
            $table->double('selisih')->default(0);
            $table->double('rp_satuan');
            $table->string('ket', 200)->nullable();
            $table->integer('gudang_id');
            $table->integer('kategori_id');
            $table->integer('departemen_id');
            $table->string('admin', 100);

            $table->index(['tgl', 'jenis', 'status', 'gudang_id', 'departemen_id'], 'tgl');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_stok_produk');
    }
};
