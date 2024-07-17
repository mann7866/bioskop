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
        Schema::create('film', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_genre')->references('id')->on('genre')->onDelete('restrict')->onUpdate('cascade');
            $table->string('judul');
            $table->foreignId('id_jamTayang')->references('id')->on('time')->onDelete('restrict')->onUpdate('cascade');
            $table->string('tanggalTayang');
            $table->foreignId('id_deskripsi')->references('id')->on('detail')->onDelete('restrict')->onUpdate('cascade');
            $table->string('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film');
    }
};
