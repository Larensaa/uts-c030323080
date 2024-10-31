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
        Schema::create('donatur', function (Blueprint $table) {
            $table->id(); // Membuat kolom id sebagai primary key
            $table->string('nama'); // Kolom untuk nama donatur
            $table->string('email')->unique(); // Kolom untuk email, harus unik
            $table->string('telepon')->nullable(); // Kolom untuk nomor telepon, bisa null
            $table->text('alamat')->nullable(); // Kolom untuk alamat, bisa null
            $table->string('foto')->nullable(); // Kolom untuk menyimpan path foto, bisa null
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donatur'); // Menghapus tabel jika migrasi dibatalkan
    }
};
