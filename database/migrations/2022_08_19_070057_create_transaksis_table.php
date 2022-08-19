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
        Schema::dropIfExists('transaksis');
        Schema::create('transaksis', function (Blueprint $table) {
            $table->string('id_transaksi',45);
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_jenis');
            $table->unsignedInteger('id_kategori');
            $table->datetime('tanggal')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->double('nominal')->nullable()->default('0');
            $table->longText('keterangan')->nullable();
            $table->tinyInteger('is_approved',)->nullable()->default('0');
            $table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->primary('id_transaksi');
            $table->foreign('id_user')->references('id_user')->on('users');
            $table->foreign('id_jenis')->references('id_jenis')->on('jenis_transaksis');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategoris');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
};
