<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('kategori_pelanggarans', function (Blueprint $table) {
            $table->string('kategori')->nullable()->after('id'); // contoh: Ringan, Sedang, Berat
            $table->text('deskripsi')->nullable()->after('poin');
        });
    }

    public function down(): void
    {
        Schema::table('kategori_pelanggarans', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'deskripsi']);
        });
    }
};
