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
        Schema::create('jurnal', function (Blueprint $table) {
            $table->increments('id_jurnal');
            $table->date('tgl')->index();
            $table->integer('id_akun')->index();
            $table->integer('id_buku')->index();
            $table->string('no_nota');
            $table->string('ket')->nullable();
            $table->string('no_dokumen')->nullable();
            $table->date('tgl_dokumen')->nullable()->index();
            $table->double('debit');
            $table->double('kredit');
            $table->string('admin');
            $table->integer('id_proyek')->nullable()->index();
            $table->integer('id_departemen')->nullable();
            $table->integer('id_post_center')->nullable();
            $table->string('no_urut')->nullable();
            $table->enum('saldo', ['T', 'Y']);
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
        Schema::dropIfExists('jurnal');
    }
};
