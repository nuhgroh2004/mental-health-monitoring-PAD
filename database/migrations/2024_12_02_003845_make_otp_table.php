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
        Schema::create('otp', function (Blueprint $table) {
            $table->id('otp_id');
            $table->unsignedBigInteger('dosen_id');
            $table->string('otp_code', 4);
            $table->enum('verified', ['yes', 'no'])->default('no');
            $table->timestamps();


            $table->foreign('dosen_id')->references('dosen_id')->on('dosen')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otp');
    }
};
