<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('aspirasis', function (Blueprint $table) {
            // Drop the enum column
            $table->dropColumn('program_studi');
        });

        Schema::table('aspirasis', function (Blueprint $table) {
            // Add the enum column with new value
            $table->enum('program_studi', ['Teknik Informatika', 'Sistem Informasi', 'Ilmu Komunikasi', 'Pariwisata', 'Dekan FTIK'])->after('jenis_aspirasi');
        });
    }

    public function down(): void
    {
        Schema::table('aspirasis', function (Blueprint $table) {
            // Drop the enum column with new value
            $table->dropColumn('program_studi');
        });

        Schema::table('aspirasis', function (Blueprint $table) {
            // Recreate the original enum column
            $table->enum('program_studi', ['Teknik Informatika', 'Sistem Informasi', 'Ilmu Komunikasi', 'Pariwisata'])->after('jenis_aspirasi');
        });
    }
};
