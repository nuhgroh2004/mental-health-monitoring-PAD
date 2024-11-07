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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('notification_id');
            $table->foreignId('dosen_id')->constrained('dosens', 'dosen_id');
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas', 'mahasiswa_id');
            $table->foreignId('report_id')->constrained('reports', 'report_id');
            $table->enum('request_status', ['diterima', 'tidak diterima', 'pending']);
            $table->enum('status', ['read', 'unread']);
            $table->dateTime('created_at');
            $table->dateTime('accepted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
