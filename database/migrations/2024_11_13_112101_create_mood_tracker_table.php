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
        Schema::create('mood_tracker', function (Blueprint $table) {
            $table->id('mood_id');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->integer('mood_level');
            $table->integer('mood_intensity');
            $table->string('mood_note', 300);
            $table->timestamps();

            $table->foreign('mahasiswa_id')
                  ->references('mahasiswa_id')
                  ->on('mahasiswa')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mood_tracker');
    }
};
