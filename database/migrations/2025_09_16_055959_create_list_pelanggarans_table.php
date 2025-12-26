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
        Schema::create('list_pelanggarans', function (Blueprint $table) {
            $table->id(); // otomatis primary key bigint unsigned
            $table->string('nisn'); // NISN siswa
            $table->string('nama_siswa'); // nama siswa
            $table->string('kelas'); // kelas siswa
            $table->text('note')->nullable(); // catatan opsional
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_pelanggarans');
    }
};
