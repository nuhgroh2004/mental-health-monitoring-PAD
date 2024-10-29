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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id('mahasiswa_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('NIM', 15)->unique();
            $table->string('prodi', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('password', 255);
            $table->string('phone_number', 11)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
