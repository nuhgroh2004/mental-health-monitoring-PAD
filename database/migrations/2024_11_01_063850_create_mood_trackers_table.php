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
        Schema::create('mood_trackers', function (Blueprint $table) {
            $table->id('mood_id');
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas', 'mahasiswa_id');
            $table->integer('mood_level');
            $table->integer('mood_intensity');
            $table->text('mood_text', 300);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mood_trackers');
    }
};
