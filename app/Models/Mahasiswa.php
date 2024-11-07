<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
    use HasFactory;
    protected $table = 'mahasiswas';

    protected $fillable = [
        'name',
        'email',
        'NIM',
        'prodi',
        'tanggal_lahir',
        'password'
    ];

    protected $hidden = [
        'password'
    ];
}
