<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'mahasiswa_id';

    protected $fillable = [
        'mahasiswa_id',
        'prodi',
        'NIM',
        'tanggal_lahir',
        'nomor_hp',
        'mahasiswa_role'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id', 'user_id');
    }

    public function mood()
    {
        return $this->hasMany(MoodTracker::class, 'mahasiswa_id', 'mahasiswa_id');
    }

    public function progresstracker()
    {
        return $this->hasMany(ProgressTracker::class, 'mahasiswa_id', 'mahasiswa_id');
    }

    public function report()
    {
        return $this->hasMany(Report::class, 'mahasiswa_id', 'mahasiswa_id');
    }
}
