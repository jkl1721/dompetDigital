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
        Schema::dropIfExists('kategoris');
        Schema::create('kategoris', function (Blueprint $table) {
            $table->increments('id_kategori');
            $table->string('nama_kategori',45)->nullable();
            $table->unsignedInteger('id_jenis');
            $table->foreign('id_jenis')->references('id_jenis')->on('jenis_transaksis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategoris');
    }
};
