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
        Schema::create('aspirasis', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('jenis_aspirasi', ['Fasilitas', 'Kebijakan', 'Pelayanan']);
            $table->enum('program_studi', ['Teknik Informatika', 'Sistem Informasi', 'Ilmu Komunikasi', 'Pariwisata']);
            $table->text('keterangan');
            $table->integer('rating')->nullable(); // Form 4 (opsional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasis');
    }
};
