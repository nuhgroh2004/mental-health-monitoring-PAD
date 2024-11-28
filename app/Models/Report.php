<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'report';
    protected $primaryKey = 'report_id';

    protected $fillable = [
        'mood_id',
        'progress_id',
        'mahasiswa_id'
    ];

    public function mood()
    {
        return $this->belongsTo(MoodTracker::class, 'mood_id', 'mood_id');
    }

    public function progress()
    {
        return $this->belongsTo(ProgressTracker::class, 'progress_id', 'progress_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'mahasiswa_id');
    }
}
