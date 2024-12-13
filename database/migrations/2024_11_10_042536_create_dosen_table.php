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
        Schema::create('dosen', function (Blueprint $table) {
            $table->unsignedBigInteger('dosen_id');
            $table->foreign('dosen_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->enum('verified', ['yes', 'no']);
            $table->timestamps();

            $table->primary('dosen_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
