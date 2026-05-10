<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InputAspirasi; 
use App\Models\Kategori;     
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{
    public function index()
    {
        // Mengambil data kategori untuk dropdown
        $kategoris = Kategori::all();
        
        // Mengambil riwayat milik siswa yang sedang login beserta relasi kategori dan tanggapan
        $riwayat = InputAspirasi::where('nis', Auth::user()->nis)
                    ->with(['kategori', 'tanggapan']) 
                    ->orderBy('tgl_input', 'desc')
                    ->get();

        return view('dashboard', compact('kategoris', 'riwayat'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'id_kategori' => 'required',
            'lokasi'      => 'required',
            'ket'         => 'required',
            'foto'        => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Batas 2MB
        ]);

        // 2. Logika Upload Foto
        $nama_foto = null; 
        if ($request->hasFile('foto')) {
            // Memberi nama unik berdasarkan waktu agar tidak bentrok
            $nama_foto = time() . '.' . $request->foto->extension();  
            
            // Pindahkan file ke folder public/uploads
            $request->foto->move(public_path('uploads'), $nama_foto);
        }

        // 3. Simpan ke Database
        // Pastikan nama kolom 'foto' ada di sini agar tersimpan
        InputAspirasi::create([
            'nis'         => Auth::user()->nis,
            'id_kategori' => $request->id_kategori,
            'lokasi'      => $request->lokasi,
            'ket'         => $request->ket,
            'foto'        => $nama_foto, // Ini yang menyimpan nama file ke DB
            'tgl_input'   => now(),
        ]);

        return back()->with('success', 'Aspirasi kamu berhasil dikirim!');
    }
}