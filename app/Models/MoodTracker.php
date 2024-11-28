<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoodTracker extends Model
{
    use HasFactory;

    protected $table = 'mood_tracker';
    protected $primaryKey = 'mood_id';

    protected $fillable = [
        'mahasiswa_id',
        'mood_level',
        'mood_intensity',
        'mood_note',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'mahasiswa_id');
    }
}
