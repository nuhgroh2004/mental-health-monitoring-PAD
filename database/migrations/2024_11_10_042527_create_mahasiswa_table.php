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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->unsignedBigInteger('mahasiswa_id');
            $table->foreign('mahasiswa_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->string('NIM', 20)->unique();
            $table->string('prodi');
            $table->date('tanggal_lahir');
            $table->string('nomor_hp', 11);
            $table->unsignedBigInteger('mahasiswa_role_id');
            $table->timestamps();

            $table->primary('mahasiswa_id');
            $table->foreign('mahasiswa_role_id')->references('mahasiswa_role_id')->on('mahasiswa_role')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
