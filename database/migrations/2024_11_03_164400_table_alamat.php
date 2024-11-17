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
      Schema::create('alamat', function (Blueprint $table) {
        $table->id('id_alamat');
        $table->string('label', 20);
        $table->string('address', 100);
        $table->text('courier_note')->nullable();
        $table->char('postalcode', 5)->nullable();
        $table->unsignedBigInteger('id_user');
        $table->timestamp('created_at')->useCurrent();

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
        Schema::dropIfExists('alamat');
    }
};
