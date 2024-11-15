<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progress_tracking', function (Blueprint $table) {
            $table->id('progress_id');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->integer('expected_target')->comment('Target time in seconds');
            $table->integer('actual_target')->comment('Actual time achieved in seconds');
            $table->boolean('is_achieved')->default(false);
            $table->date('tracking_date');
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('mahasiswa_id')->on('mahasiswa')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progress_tracking');
    }
};
