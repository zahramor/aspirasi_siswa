@extends('layouts.admin')

@section('content')

{{-- HEADER & FILTER CETAK PDF --}}
<div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 20px; flex-wrap: wrap; gap: 20px;">
    <div>
        <div class="page-title" style="margin-bottom: 0;">Overview Dashboard</div>
        <p style="color: var(--gray); font-size: 14px; margin-top: 5px;">Selamat bekerja, {{ Auth::guard('admin')->user()->username }}!</p>
    </div>
    
    {{-- Form Filter PDF - Hanya muncul jika role adalah superadmin --}}
    @if(Auth::guard('admin')->user()->role === 'superadmin')
        <form action="{{ route('admin.cetak') }}" method="GET" style="display: flex; gap: 10px; align-items: flex-end; background: #f8f9fa; padding: 15px; border-radius: 10px; border: 1px solid #e9ecef;">
            <div>
                <label style="font-size: 11px; font-weight: bold; display: block; margin-bottom: 5px; color: #495057;">Kategori:</label>
                <select name="kategori" style="padding: 8px; border-radius: 5px; border: 1px solid #ced4da; font-size: 13px; min-width: 150px;">
                    <option value="">Semua Kategori</option>
                    <option value="Pengajaran">Pengajaran</option>
                    <option value="Keamanan dan Keselamatan">Keamanan & Keselamatan</option>
                    <option value="Akademik dan Kinerja Guru">Akademik & Kinerja Guru</option>
                    <option value="Fasilitas dan Lingkungan Sekolah">Fasilitas & Lingkungan</option>
                    <option value="Kebijakan Sekolah dan Sosial">Kebijakan & Sosial</option>
                </select>
            </div>
            <div>
                <label style="font-size: 11px; font-weight: bold; display: block; margin-bottom: 5px; color: #495057;">Status:</label>
                <select name="status" style="padding: 8px; border-radius: 5px; border: 1px solid #ced4da; font-size: 13px; min-width: 100px;">
                    <option value="">Semua Status</option>
                    <option value="Belum">Belum</option>
                    <option value="Proses">Proses</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>
            <button type="submit" class="btn-aksi btn-selesai" style="padding: 9px 15px; text-decoration: none; display: flex; align-items: center; gap: 8px; cursor: pointer; border: none;">
                <i class="fa-solid fa-file-pdf"></i> Unduh PDF
            </button>
        </form>
    @endif
</div>

{{-- ALERT INDIKATOR ROLE --}}
<div style="margin-bottom: 25px;">
    @if(Auth::guard('admin')->user()->role === 'superadmin')
        <div style="background: #e3f2fd; color: #0d47a1; padding: 12px 15px; border-radius: 8px; border-left: 5px solid #1976d2; font-size: 14px; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-user-check"></i> 
            <span>Login sebagai <strong>Super Admin</strong>. Anda memiliki akses monitoring dan laporan PDF.</span>
        </div>
    @else
        <div style="background: #fff3cd; color: #856404; padding: 12px 15px; border-radius: 8px; border-left: 5px solid #ffca28; font-size: 14px; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-user-shield"></i> 
            <span>Login sebagai <strong>Admin</strong>. Silakan kelola tanggapan aspirasi siswa.</span>
        </div>
    @endif
</div>

{{-- STATS GRID --}}
<div class="stats-grid">
    <a href="/admin/dashboard" class="stat-card">
        <div class="stat-icon gray"><i class="fa-solid fa-list-check"></i></div>
        <div>
            <div class="stat-num">{{ $aspirasi->total() }}</div> 
            <div class="stat-label">Total Aspirasi</div>
        </div>
    </a>

    <a href="/admin/dashboard?status=Belum" class="stat-card">
        <div class="stat-icon orange"><i class="fa-solid fa-hourglass-half"></i></div>
        <div>
            <div class="stat-num">{{ $totalBelum }}</div>
            <div class="stat-label">Belum Ditanggapi</div>
        </div>
    </a>

    <a href="/admin/dashboard?status=Proses" class="stat-card">
        <div class="stat-icon blue"><i class="fa-solid fa-spinner"></i></div>
        <div>
            <div class="stat-num">{{ $totalProses }}</div>
            <div class="stat-label">Sedang Diproses</div>
        </div>
    </a>

    <a href="/admin/dashboard?status=Selesai" class="stat-card">
        <div class="stat-icon green"><i class="fa-solid fa-circle-check"></i></div>
        <div>
            <div class="stat-num">{{ $totalSelesai }}</div>
            <div class="stat-label">Selesai</div>
        </div>
    </a>
</div>

{{-- TABEL DATA --}}
<div class="table-card">
    <div class="table-header">
        <h2><i class="fa-solid fa-inbox"></i> Daftar Aspirasi Masuk</h2>
        <span class="table-count">Halaman {{ $aspirasi->currentPage() }} dari {{ $aspirasi->lastPage() }}</span>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Info Siswa</th>
                    <th>Kategori</th>
                    <th>Laporan & Foto</th>
                    <th>Status & Waktu</th>
                    <th>Aksi Tanggapan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($aspirasi as $a)
                @php
                    $status = $a->tanggapan->status ?? 'Belum';
                    $isSelesai = ($status == 'Selesai');
                    $badgeClass = strtolower($status) == 'belum' ? 'badge-belum' : (strtolower($status) == 'proses' ? 'badge-proses' : 'badge-selesai');
                    $userRole = Auth::guard('admin')->user()->role;
                @endphp
                <tr>
                    <td>
                        <div class="student-name">{{ $a->siswa->nama }}</div>
                        <div class="student-meta">
                            NIS: {{ $a->nis }} <br>
                            Kelas: {{ $a->siswa->kelas ?? '-' }} <br>
                            <small>{{ \Carbon\Carbon::parse($a->tgl_input)->format('d M Y, H:i') }}</small>
                        </div>
                    </td>

                    <td>
                        <span class="badge" style="background:var(--accent-light); color:var(--primary-mid); border:1px solid var(--border); text-transform:none; padding: 5px 10px;">
                            {{ $a->kategori->ket_kategori ?? 'Umum' }}
                        </span>
                    </td>

                    <td>
                        @if($a->foto)
                            <img src="{{ asset('uploads/'.$a->foto) }}" class="laporan-img" style="width:60px; height:60px; object-fit:cover; border-radius:4px; margin-bottom:5px; cursor:pointer;" onclick="window.open(this.src)">
                        @else
                            <div style="color: #ccc; font-size: 10px;">Tanpa Foto</div>
                        @endif
                        <div class="laporan-ket" style="font-size: 13px;">{{ \Illuminate\Support\Str::limit($a->ket, 80) }}</div>
                    </td>

                    <td>
                        <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                        <div style="margin-top: 8px; font-size: 10px; color: var(--gray);">
                            @if($a->tanggapan && $a->tanggapan->tgl_proses)
                                <div><i class="fa-solid fa-clock"></i> P: {{ \Carbon\Carbon::parse($a->tanggapan->tgl_proses)->format('d/m H:i') }}</div>
                            @endif
                            @if($a->tanggapan && $a->tanggapan->tgl_selesai)
                                <div><i class="fa-solid fa-check"></i> S: {{ \Carbon\Carbon::parse($a->tanggapan->tgl_selesai)->format('d/m H:i') }}</div>
                            @endif
                        </div>
                    </td>

                    <td>
                        @if($userRole === 'superadmin')
                            <div style="background: #f8f9fa; padding: 10px; border-radius: 6px; border: 1px solid #dee2e6; min-width: 200px;">
                                <small style="font-weight: bold; color: #6c757d; display: block; margin-bottom: 5px;">Feedback Admin:</small>
                                <p style="margin: 0; font-size: 13px; line-height: 1.4;">{{ $a->tanggapan->feedback ?? 'Belum ada tanggapan.' }}</p>
                                
                                @if($a->tanggapan && $a->tanggapan->foto_tanggapan)
                                    <div style="margin-top: 8px;">
                                        <img src="{{ asset('uploads/tanggapan/'.$a->tanggapan->foto_tanggapan) }}" style="width:45px; height:45px; object-fit: cover; border-radius:4px; border:1px solid #ddd; cursor:pointer;" onclick="window.open(this.src)">
                                    </div>
                                @endif
                            </div>
                        @else
                            <form action="/admin/tanggapan/{{ $a->id_pelaporan }}" method="POST" enctype="multipart/form-data" class="aksi-form">
                                @csrf
                                <textarea name="feedback" 
                                          placeholder="Tulis feedback..." 
                                          {{ $isSelesai ? 'readonly' : 'required' }}
                                          style="{{ $isSelesai ? 'background:#f9f9f9; cursor:not-allowed;' : '' }}">{{ $a->tanggapan->feedback ?? '' }}</textarea>

                                @if(!$isSelesai)
                                    <div style="margin-top:5px;">
                                        <input type="file" name="foto_tanggapan" style="font-size:10px;">
                                    </div>
                                @endif

                                @if($a->tanggapan && $a->tanggapan->foto_tanggapan)
                                    <div style="margin-top:5px;">
                                        <img src="{{ asset('uploads/tanggapan/'.$a->tanggapan->foto_tanggapan) }}" style="width:50px; border-radius:4px; border:1px solid #ddd; cursor:pointer;" onclick="window.open(this.src)">
                                    </div>
                                @endif

                                <div class="aksi-btns" style="margin-top: 10px;">
                                    <button name="status" value="Proses" class="btn-aksi btn-proses" {{ $isSelesai ? 'disabled style=opacity:0.5;cursor:not-allowed' : '' }}>
                                        Proses
                                    </button>
                                    <button name="status" value="Selesai" class="btn-aksi btn-selesai" {{ $isSelesai ? 'disabled style=opacity:0.5;cursor:not-allowed' : '' }}>
                                        Selesai
                                    </button>
                                </div>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align:center; padding:40px; color: var(--gray);">Belum ada data aspirasi masuk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding: 15px; display: flex; justify-content: center;">
        {{ $aspirasi->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection