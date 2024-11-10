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
      Schema::create('pengiriman', function (Blueprint $table) {
        $table->id('id_pengiriman');
        $table->unsignedBigInteger('id_pesanan');
        $table->timestamp('waktukirim')->useCurrent();
        $table->timestamp('waktusampai')->nullable();
        $table->string('status', 20)->default('Dalam Pengiriman');

        // Foreign key constraint
        $table->foreign('id_pesanan')
              ->references('id_pesanan')
              ->on('pesanan')
              ->onDelete('cascade')
              ->onUpdate('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman');
    }
};
