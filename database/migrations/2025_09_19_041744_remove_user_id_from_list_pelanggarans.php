<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('list_pelanggarans', function (Blueprint $table) {
            // Drop foreign key jika ada
            if (Schema::hasColumn('list_pelanggarans', 'user_id')) {
                $table->dropForeign(['user_id']); // hapus relasi ke tabel users
                $table->dropColumn('user_id');    // hapus kolom user_id
            }
        });
    }

    public function down(): void
    {
        Schema::table('list_pelanggarans', function (Blueprint $table) {
            if (!Schema::hasColumn('list_pelanggarans', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');

                // tambahkan foreign key lagi ke tabel users
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }
};
