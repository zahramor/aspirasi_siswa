<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run() {
    $data = [
        ['ket_kategori' => 'Pengajaran'],
        ['ket_kategori' => 'Keamanan dan Keselamatan'],
        ['ket_kategori' => 'Akademik dan Kinerja Guru'],
        ['ket_kategori' => 'Fasilitas dan Lingkungan Sekolah'],
        ['ket_kategori' => 'Kebijakan Sekolah dan Sosial'],
    ];
    foreach($data as $d) { \App\Models\Kategori::create($d); }
}
}
