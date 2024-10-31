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
        Schema::create('donasi', function (Blueprint $table) {
            $table->id(); // Kolom id sebagai primary key
            $table->foreignId('donatur_id')->constrained('donatur')->onDelete('cascade'); // Relasi dengan tabel donatur
            $table->decimal('jumlah', 10, 2); // Kolom untuk jumlah donasi
            $table->text('deskripsi')->nullable(); // Kolom untuk deskripsi, bisa null
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasi'); // Menghapus tabel jika migrasi dibatalkan
    }
};
