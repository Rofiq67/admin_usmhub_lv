<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the enum column
            $table->dropColumn('progdi');
        });

        Schema::table('users', function (Blueprint $table) {
            // Add the enum column with new value
            $table->enum('progdi', ['Teknik Informatika', 'Sistem Informasi', 'Ilmu Komunikasi', 'Pariwisata', 'Dekan FTIK'])->after('tgl_lahir');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the enum column with new value
            $table->dropColumn('progdi');
        });

        Schema::table('users', function (Blueprint $table) {
            // Recreate the original enum column
            $table->enum('progdi', ['Teknik Informatika', 'Sistem Informasi', 'Ilmu Komunikasi', 'Pariwisata'])->after('tgl_lahir');
        });
    }
};
