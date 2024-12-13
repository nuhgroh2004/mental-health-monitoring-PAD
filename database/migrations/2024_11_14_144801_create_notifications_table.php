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
            $table->unsignedBigInteger('progress_id')->nullable();
            $table->unsignedBigInteger('mood_id')->nullable();
            $table->enum('request_status', ['accepted', 'rejected', 'pending'])->default('pending');
            $table->enum('read_status', ['read', 'unread'])->default('unread');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('accepted_at')->nullable();

            $table->foreign('dosen_id')->references('dosen_id')->on('dosen')->onDelete('cascade');
            $table->foreign('mahasiswa_id')->references('mahasiswa_id')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('progress_id')->references('progress_id')->on('progress_tracking')->onDelete('cascade');
            $table->foreign('mood_id')->references('mood_id')->on('mood_tracker')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
