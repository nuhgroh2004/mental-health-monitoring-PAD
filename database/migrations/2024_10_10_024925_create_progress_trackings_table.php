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
        Schema::create('progress_trackings', function (Blueprint $table) {
            $table->id('progress_id');
            $table->foreignId('user_id')->constrained('mahasiswas', 'user_id');
            $table->integer('report_target');
            $table->integer('realised_report_target');
            $table->timestamps();
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
