<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;

    protected $table = 'otp';
    protected $primaryKey = 'otp_id';
    protected $fillable = [
        'dosen_id',
        'otp_code',
        'verified',
        'is_expired',
        'created_at',
    ];
    protected $dates = ['created_at', 'updated_at', 'expired_at'];
    
    protected static function booted()
    {
        static::creating(function ($model) {
            // If expired_at is not set, default to 5 minutes from now
            $model->expired_at = $model->expired_at ?? now()->addMinutes(5);
        });
    }
    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
