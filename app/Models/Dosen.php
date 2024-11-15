<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
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

    public function notification()
    {
        return $this->hasMany(Notification::class, 'dosen_id', 'dosen_id');
    }
}
