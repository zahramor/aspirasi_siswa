<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InputAspirasi;
use App\Models\TanggapanAspirasi;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth; // Tambahkan ini
use App\Models\Aspirasi; // Ini yang paling penting untuk memperbaiki error tadi
use App\Models\Kategori; // Tambahkan juga jika kamu memakainya di controller ini
use Barryvdh\DomPDF\Facade\Pdf; // P besar, df kecil
class AdminController extends Controller
{
    // 1. TAMBAHKAN CONSTRUCT UNTUK MIDDLEWARE
    public function __construct()
    {
        // Ini memastikan hanya admin yang sudah login yang bisa mengakses fungsi di controller ini
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $statusFilter = $request->query('status');

        $query = InputAspirasi::with(['kategori', 'tanggapan', 'siswa']);

        if ($statusFilter) {
            if ($statusFilter == 'Belum') {
                $query->doesntHave('tanggapan');
            } else {
                $query->whereHas('tanggapan', function ($q) use ($statusFilter) {
                    $q->where('status', $statusFilter);
                });
            }
        }

        // PERBAIKAN: Gunakan $query yang sudah difilter tadi, jangan buat query baru
        $aspirasi = $query->latest()->paginate(10);

        // Statistik
        $totalBelum = InputAspirasi::whereDoesntHave('tanggapan')->count();
        $totalProses = TanggapanAspirasi::where('status', 'Proses')->count();
        $totalSelesai = TanggapanAspirasi::where('status', 'Selesai')->count();

        return view('admin.dashboard', compact('aspirasi', 'totalBelum', 'totalProses', 'totalSelesai'));
    }

    public function berikanTanggapan(Request $request, $id_pelaporan)
    {
        $request->validate([
            'feedback'       => 'required|string',
            'status'         => 'required|in:Proses,Selesai',
            'foto_tanggapan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $tanggapanLama = TanggapanAspirasi::where('id_pelaporan', $id_pelaporan)->first();
        $fotoName = $tanggapanLama ? $tanggapanLama->foto_tanggapan : null;

        if ($request->hasFile('foto_tanggapan')) {
            if ($fotoName && file_exists(public_path('uploads/tanggapan/' . $fotoName))) {
                unlink(public_path('uploads/tanggapan/' . $fotoName));
            }

            $fotoName = time() . '_admin.' . $request->foto_tanggapan->extension();
            $request->foto_tanggapan->move(public_path('uploads/tanggapan'), $fotoName);
        }

        $dataUpdate = [
            'feedback'       => $request->feedback,
            'status'         => $request->status,
            'foto_tanggapan' => $fotoName,
        ];

        if ($request->status == 'Proses') {
            $dataUpdate['tgl_proses'] = now();
        } elseif ($request->status == 'Selesai') {
            if (!$tanggapanLama || !$tanggapanLama->tgl_proses) {
                $dataUpdate['tgl_proses'] = now();
            }
            $dataUpdate['tgl_selesai'] = now();
        }

        TanggapanAspirasi::updateOrCreate(
            ['id_pelaporan' => $id_pelaporan],
            $dataUpdate
        );

        return back()->with('success', 'Tanggapan berhasil diperbarui!');
    }

    public function dataSiswa()
    {
        $siswa = Siswa::all();
        return view('admin.data_siswa', compact('siswa'));
    }

    public function hapusSiswa($nis)
    {
        $siswa = Siswa::where('nis', $nis)->first();

        if ($siswa) {
            $aspirasiIds = InputAspirasi::where('nis', $nis)->pluck('id_pelaporan');
            TanggapanAspirasi::whereIn('id_pelaporan', $aspirasiIds)->delete();
            InputAspirasi::where('nis', $nis)->delete();
            $siswa->delete();

            return back()->with('success', 'Data siswa dan aspirasinya berhasil dihapus!');
        }

        return back()->with('error', 'Siswa tidak ditemukan!');
    }

    public function cetakPDF(Request $request)
{
    // Pastikan hanya superadmin yang bisa akses
    if (Auth::guard('admin')->user()->role !== 'superadmin') {
        abort(403);
    }

    // Mulai query
    $query = InputAspirasi::with(['siswa', 'kategori', 'tanggapan']);

    // Filter berdasarkan Kategori (jika dipilih)
    if ($request->filled('kategori')) {
        $query->whereHas('kategori', function($q) use ($request) {
            $q->where('ket_kategori', $request->kategori);
        });
    }

    // Filter berdasarkan Status (jika dipilih)
    if ($request->filled('status')) {
        $query->whereHas('tanggapan', function($q) use ($request) {
            $q->where('status', $request->status);
        });
    }

    $aspirasi = $query->get();

  $pdf = Pdf::loadView('admin.laporan_pdf', compact('aspirasi'))
          ->setPaper('a4', 'landscape');
    return $pdf->download('laporan-aspirasi-'.date('Y-m-d').'.pdf');
}
}