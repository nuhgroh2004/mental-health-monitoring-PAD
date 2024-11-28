<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';
    protected $primaryKey = 'notification_id';

    protected $fillable = [
        'dosen_id',
        'mahasiswa_id',
        'report_id',
        'request_status',
        'read_status',
        'accepted_at',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id', 'dosen_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'mahasiswa_id');
    }

    public function mood()
    {
        return $this->hasMany(MoodTracker::class, 'mahasiswa_id', 'mahasiswa_id');
    }

    public function progresstracker()
    {
        return $this->hasMany(ProgressTracker::class, 'mahasiswa_id', 'mahasiswa_id');
    }
}
