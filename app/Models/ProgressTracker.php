<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressTracker extends Model
{
    use HasFactory;

    protected $table = 'progress_tracking';
    protected $primaryKey = 'progress_id';

    protected $fillable = [
        'mahasiswa_id',
        'expected_target',
        'actual_target',
        'is_achieved',
        'tracking_date'
    ];

    protected $casts = [
        'is_achieved' => 'boolean',
        'tracking_date' => 'date'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'mahasiswa_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'progress_id', 'progress_id');
    }
}
