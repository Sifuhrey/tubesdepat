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
      Schema::create('produk', function (Blueprint $table) {
        $table->id('id_produk');
        $table->string('productname', 50);
        $table->string('category', 15);
        $table->integer('price');
        $table->integer('stock');
        $table->text('description');
        $table->string('imgname', 100);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
