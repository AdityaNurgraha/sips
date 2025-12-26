<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('list_pelanggarans', function (Blueprint $table) {
            // Tambahkan kolom siswa_id terlebih dahulu nullable
            $table->unsignedBigInteger('siswa_id')->nullable()->after('id');

            // Tambahkan foreign key
            $table->foreign('siswa_id')
                  ->references('id')
                  ->on('siswa')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('list_pelanggarans', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->dropColumn('siswa_id');
        });
    }
};
