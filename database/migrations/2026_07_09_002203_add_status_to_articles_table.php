<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
        // Menambahkan kolom status, bisa di-set default 'draft' atau 'pending'
        $table->string('status')->default('draft')->after('content'); 
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
        // Menghapus kolom jika di-rollback
        $table->dropColumn('status');
        });
    }
};
