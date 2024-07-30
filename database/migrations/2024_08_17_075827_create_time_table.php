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
        Schema::create('time', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_judul')->references('id')->on('detail')->onDelete('restrict')->onUpdate('cascade');
            $table->time('jamTayang');
            $table->date('tanggalTayang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time');
    }
};
