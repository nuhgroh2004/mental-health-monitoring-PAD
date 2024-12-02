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
        'created_at',
        'verified',
    ];
    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
