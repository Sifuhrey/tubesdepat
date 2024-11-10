<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      Schema::create('pesanan', function (Blueprint $table) {
        $table->id('id_pesanan');
        $table->unsignedBigInteger('id_user');
        $table->unsignedBigInteger('id_transaksi')->nullable();
        $table->unsignedBigInteger('id_produk');
        $table->unsignedBigInteger('id_alamat')->nullable();
        $table->integer('quantity');

        // Foreign key constraints
        $table->foreign('id_user')
              ->references('id_user')
              ->on('user')
              ->onDelete('cascade')
              ->onUpdate('cascade');

        $table->foreign('id_transaksi')
              ->references('id_transaksi')
              ->on('transaksi')
              ->onDelete('set null')
              ->onUpdate('cascade');

        $table->foreign('id_produk')
              ->references('id_produk')
              ->on('produk')
              ->onDelete('cascade')
              ->onUpdate('cascade');

        $table->foreign('id_alamat')
              ->references('id_alamat')
              ->on('alamat')
              ->onDelete('set null')
              ->onUpdate('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
