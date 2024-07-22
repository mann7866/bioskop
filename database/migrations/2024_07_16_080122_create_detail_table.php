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
        Schema::create('detail', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('pemeran');
            $table->date('tanggalRilis');
            $table->string('penulis');
            $table->string('sutradara');
            $table->string('perusahaanProduksi');
            $table->text('deskripsi');
            $table->string('foto');
            $table->string('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail');
    }
};
