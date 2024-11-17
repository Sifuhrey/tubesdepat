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
      Schema::create('wishlist', function (Blueprint $table) {
        $table->id('id_wishlist');
        $table->unsignedBigInteger('id_user')->nullable();
        $table->unsignedBigInteger('id_produk')->nullable();

        // Foreign key constraints
        $table->foreign('id_user')
              ->references('id_user')
              ->on('users')
              ->onDelete('set null')
              ->onUpdate('cascade');

        $table->foreign('id_produk')
              ->references('id_produk')
              ->on('produk')
              ->onDelete('set null')
              ->onUpdate('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlist');
    }
};
