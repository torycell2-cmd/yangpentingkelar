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
        // Menambahkan kolom views, tipe data integer, default 0
        $table->integer('views')->default(0)->after('status'); 
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
        $table->dropColumn('views');
        });
    }   
};
