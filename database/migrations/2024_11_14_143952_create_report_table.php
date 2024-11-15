<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('report', function (Blueprint $table) {
            $table->id('report_id');
            $table->unsignedBigInteger('mood_id');
            $table->unsignedBigInteger('progress_id');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->timestamps();

            $table->foreign('mood_id')->references('mood_id')->on('mood_tracker')->onDelete('cascade');
            $table->foreign('progress_id')->references('progress_id')->on('progress_tracking')->onDelete('cascade');
            $table->foreign('mahasiswa_id')->references('mahasiswa_id')->on('mahasiswa')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report');
    }
};
