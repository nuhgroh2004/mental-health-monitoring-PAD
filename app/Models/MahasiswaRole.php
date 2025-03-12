<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaRole extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa_role';
    protected $primaryKey = 'mahasiswa_role_id';

    protected $fillable = [
        "mahasiswa_role_id",
        "name",
        "min_intensity",
        "max_intensity"
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(mahasiswa::class, 'mahasiswa_role_id', 'mahasiswa_role_id');
    }
}
