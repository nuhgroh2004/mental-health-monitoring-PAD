<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->enum('is_expired', ['yes', 'no'])->default('no');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('expired_at')->nullable();

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
