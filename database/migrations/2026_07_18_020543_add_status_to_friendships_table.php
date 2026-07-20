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
        Schema::table('friendships', function (Blueprint $table) {
        // Tambahkan kolom status dengan default 'pending'
            $table->string('status')->default('pending');
        });
    }

    public function down()
    {
        Schema::table('friendships', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
