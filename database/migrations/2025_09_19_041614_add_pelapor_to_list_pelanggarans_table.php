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
    Schema::table('list_pelanggarans', function (Blueprint $table) {
        $table->string('pelapor')->nullable()->after('kelas');
    });
}

public function down()
{
    Schema::table('list_pelanggarans', function (Blueprint $table) {
        $table->dropColumn('pelapor');
    });
}

};
