<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('list_pelanggarans', function (Blueprint $table) {
        $table->unsignedBigInteger('kategori_pelanggaran_id')->nullable()->after('id');

        $table->foreign('kategori_pelanggaran_id')
              ->references('id')
              ->on('kategori_pelanggarans')
              ->onDelete('set null');
    });
}

public function down()
{
    Schema::table('list_pelanggarans', function (Blueprint $table) {
        $table->dropForeign(['kategori_pelanggaran_id']);
        $table->dropColumn('kategori_pelanggaran_id');
    });
}

};
