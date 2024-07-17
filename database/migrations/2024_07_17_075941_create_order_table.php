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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string('genre');
            $table->foreignId('judul');
            $table->string('deskripsi');
            $table->foreignId('id_studio')->references('id')->on('lokasi')->onDelete('restrict')->onUpdate('cascade');
            $table->string('harga');
            $table->string('kursi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
