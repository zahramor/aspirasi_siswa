<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Penting untuk Login

class Siswa extends Authenticatable
{
    protected $table = 'siswas';
    protected $primaryKey = 'nis'; // Karena kita pakai NIS, bukan ID
    public $incrementing = false; // Karena NIS biasanya bukan auto-increment

    protected $fillable = [
        'nis', 'nisn', 'nama', 'kelas', 'gmail', 'password', 'siswa'
    ];

    protected $hidden = [
        'password',
    ];
}