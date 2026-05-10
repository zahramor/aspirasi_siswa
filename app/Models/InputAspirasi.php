<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InputAspirasi extends Model
{
    protected $table = 'input_aspirasis';
    protected $primaryKey = 'id_pelaporan';
    
    // TAMBAHKAN 'foto' ke dalam list ini!
    protected $fillable = [
        'nis', 
        'id_kategori', 
        'lokasi', 
        'ket', 
        'foto', 
        'tgl_input'
    ];

    public $timestamps = false; // Jika tabelmu tidak pakai created_at/updated_at

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function tanggapan()
    {
        return $this->hasOne(TanggapanAspirasi::class, 'id_pelaporan', 'id_pelaporan');
    }
    
    public function siswa()
    {
       
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }
}