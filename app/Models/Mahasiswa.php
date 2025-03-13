<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'mahasiswa_id';

    protected $fillable = [
        'mahasiswa_id',
        'prodi',
        'NIM',
        'tanggal_lahir',
        'nomor_hp',
        'mahasiswa_role_id'
    ];

    public function moodProgressData($startDate)
    {
        // Ambil mood dan progress mahasiswa dari model terkait
        return $this->mood() // Mengambil mood
            ->where('created_at', '>=', $startDate)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($mood) {
                // Ambil data progress dari mahasiswa yang sesuai dengan tanggal mood
                $progress = $this->progresstracker()  // Akses progress dari model Mahasiswa
                    ->whereDate('created_at', $mood->created_at->toDateString())
                    ->first();

                return [
                    'date' => $mood->created_at->format('d M Y'),
                    'mood_level' => $mood->mood_level,
                    'mood_intensity' => $mood->mood_intensity,
                    'expected_target' => $progress ? $progress->expected_target : 'N/A',
                    'actual_target' => $progress ? $progress->actual_target : 'N/A',
                ];
            });
    }

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

    public function mahasiswarole()
    {
        return $this->hasOne(MahasiswaRole::class, 'mahasiswa_role_id', 'mahasiswa_role_id');
    }

    public function role()
{
    return $this->belongsTo(MahasiswaRole::class, 'mahasiswa_role_id', 'mahasiswa_role_id');
}

}
