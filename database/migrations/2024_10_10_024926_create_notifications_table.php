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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('notification_id');
            $table->foreignId('admin_id')->nullable()->constrained('admins', 'admin_id');
            $table->foreignId('user_id')->nullable()->constrained('mahasiswas', 'user_id');
            $table->foreignId('report_id')->nullable()->constrained('reports', 'report_id');
            $table->enum('notif_type', ['izin_diterima', 'izin_ditolak']);
            $table->enum('status', ['read', 'unread'])->default('unread');
            $table->timestamp('accepted_at')->nullable();
            $table->timestamps();
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
