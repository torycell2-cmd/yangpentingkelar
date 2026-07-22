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
    Schema::create('activity_logs', function (Blueprint $table) {
        $table->id();
        $table->string('title');        // Contoh: "Siswa Baru Terdaftar"
        $table->text('description');    // Contoh: "Akun siswa baru atas nama Dimas telah diverifikasi."
        $table->string('type')->default('info'); // Pilihan warna: 'success', 'warning', 'info'
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
