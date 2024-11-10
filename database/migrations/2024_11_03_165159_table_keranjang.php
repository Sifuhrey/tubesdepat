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
      Schema::create('keranjang', function (Blueprint $table) {
        $table->id('id_keranjang');
        $table->unsignedBigInteger('id_user');
        $table->unsignedBigInteger('id_produk');
        $table->integer('quantity');

        // Foreign key constraints
        $table->foreign('id_user')
              ->references('id_user')
              ->on('user')
              ->onDelete('cascade')
              ->onUpdate('cascade');

        $table->foreign('id_produk')
              ->references('id_produk')
              ->on('produk')
              ->onDelete('cascade')
              ->onUpdate('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang');
    }
};
