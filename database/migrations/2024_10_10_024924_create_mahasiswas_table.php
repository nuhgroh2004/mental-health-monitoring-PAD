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
            $table->id('user_id');
            $table->string('name', 100);
            $table->string('email', 50)->unique();
            $table->string('NIM', 13)->unique();
            $table->string('password', 255);
            $table->string('phone_number', 10)->nullable();
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
