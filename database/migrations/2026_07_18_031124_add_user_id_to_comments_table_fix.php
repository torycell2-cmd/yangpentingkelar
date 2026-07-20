<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            // Kita pakai pengecekan hasColumn agar tidak error duplicate
            if (!Schema::hasColumn('comments', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('forum_id')->constrained()->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        // ... kode down biarkan saja
    }
};