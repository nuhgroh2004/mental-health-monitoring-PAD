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
            $table->string('NIM', 13)->unique();
            $table->string('prodi', 100);
            $table->date('tanggal_lahir');
            $table->string('nomor_hp', 11);
            $table->enum('mahasiswa_role', ['role_1', 'role_2']);
            $table->timestamps();

            $table->primary('mahasiswa_id');
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
