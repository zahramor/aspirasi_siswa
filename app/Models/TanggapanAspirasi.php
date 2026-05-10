<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TanggapanAspirasi extends Model
{
    protected $table = 'tanggapan_aspirasis';
    protected $primaryKey = 'id_aspirasi';
    protected $fillable = ['id_pelaporan', 
    'feedback', 
    'status', 
    'foto_tanggapan', 
    'tgl_proses',  // Tambahkan ini
    'tgl_selesai'  // Tambahkan ini
];
}