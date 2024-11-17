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
      Schema::dropIfExists('transaksi');
      Schema::create('transaksi', function (Blueprint $table) {
        $table->id('id_transaksi');
        $table->unsignedBigInteger('id_user');
        $table->string('imgbayar', 70);
        $table->integer('amount');
        $table->boolean('statusbayar')->default(false);
        $table->timestamp('waktu_bayar')->useCurrent();

        // Foreign key constraint
        $table->foreign('id_user')
              ->references('id_user')
              ->on('users')
              ->onDelete('cascade')
              ->onUpdate('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
