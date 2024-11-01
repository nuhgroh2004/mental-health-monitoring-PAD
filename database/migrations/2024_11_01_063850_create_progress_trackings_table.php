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
        Schema::create('progress_trackings', function (Blueprint $table) {
            $table->id('progress_id');
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas', 'mahasiswa_id');
            $table->integer('report_target');
            $table->integer('realised_report_target');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_trackings');
    }
};
