<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Dosen extends Authenticatable
{
    use HasFactory;
    protected $table = 'dosens';

    protected $fillable =[
        'name',
        'email',
        'password'
    ];

    protected $hidden =[
        'password'
    ];
}
