<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Dosen extends Authenticatable
{
    use HasFactory;

    protected $table = 'dosen';
    protected $primaryKey = 'dosen_id';

    protected $fillable = [
        'dosen_id',
        'verified'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
