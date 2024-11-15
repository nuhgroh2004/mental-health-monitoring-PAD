<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('notification_id');
            $table->unsignedBigInteger('dosen_id');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('report_id')->nullable();
            $table->enum('request_status', ['accepted', 'rejected', 'pending'])->default('pending');
            $table->enum('status', ['read', 'unread'])->default('unread');
            $table->timestamps();
            $table->timestamp('accepted_at')->nullable();

            $table->foreign('dosen_id')->references('dosen_id')->on('dosen')->onDelete('cascade');
            $table->foreign('mahasiswa_id')->references('mahasiswa_id')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('report_id')->references('report_id')->on('report')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
