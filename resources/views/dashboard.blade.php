<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa – Sistem Aspirasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary: #4F46E5;
            --primary-light: #EEF2FF;
            --primary-dark: #3730A3;
            --accent: #06B6D4;
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
            --sidebar-bg: #1E1B4B;
            --sidebar-hover: #312E81;
            --sidebar-active: #4F46E5;
            --text-dark: #1E293B;
            --text-mid: #64748B;
            --text-light: #94A3B8;
            --border: #E2E8F0;
            --bg: #F1F5F9;
            --white: #FFFFFF;
            --card-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 4px 16px rgba(79,70,229,0.06);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text-dark);
            display: flex;
            min-height: 100vh;
        }

        /* ─── SIDEBAR ─── */
        .sidebar {
            width: 220px;
            min-height: 100vh;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 100;
            transition: width .3s;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }

        .logo-icon {
            width: 36px; height: 36px;
            background: var(--primary);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; font-weight: 800; color: white;
            flex-shrink: 0;
        }

        .logo-text {
            font-size: 18px; font-weight: 800;
            color: white; letter-spacing: -0.3px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            display: flex; flex-direction: column; gap: 2px;
        }

        .nav-item {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 12px;
            border-radius: 10px;
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            font-size: 13.5px; font-weight: 500;
            transition: all .2s;
        }

        .nav-item i { width: 18px; text-align: center; font-size: 15px; }

        .nav-item:hover { background: var(--sidebar-hover); color: white; }
        .nav-item.active { background: var(--sidebar-active); color: white; }

        .nav-item.logout { color: #F87171; margin-top: auto; }
        .nav-item.logout:hover { background: rgba(239,68,68,0.15); color: #FCA5A5; }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,0.07);
            font-size: 11px; color: rgba(255,255,255,0.3);
            line-height: 1.6;
        }

        /* ─── MAIN ─── */
        .main {
            margin-left: 220px;
            flex: 1;
            display: flex; flex-direction: column;
        }

        /* ─── TOPBAR ─── */
        .topbar {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0 32px;
            height: 64px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 50;
        }

        .topbar-title {
            font-size: 20px; font-weight: 700; color: var(--text-dark);
        }

        .topbar-right {
            display: flex; align-items: center; gap: 16px;
        }

        .icon-btn {
            width: 38px; height: 38px;
            border-radius: 10px; border: 1px solid var(--border);
            background: var(--white);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: var(--text-mid); font-size: 15px;
            position: relative; transition: all .2s;
        }

        .icon-btn:hover { background: var(--primary-light); color: var(--primary); border-color: var(--primary); }

        .notif-dot {
            width: 7px; height: 7px; border-radius: 50%;
            background: var(--danger);
            position: absolute; top: 8px; right: 8px;
            border: 2px solid white;
        }

        .user-pill {
            display: flex; align-items: center; gap: 10px;
            padding: 5px 14px 5px 5px;
            border: 1px solid var(--border);
            border-radius: 40px; cursor: pointer;
            background: var(--white);
            transition: background .2s;
        }
        .user-pill:hover { background: var(--primary-light); }

        .user-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700; color: white;
        }

        .user-info { line-height: 1.3; }
        .user-name { font-size: 13px; font-weight: 600; color: var(--text-dark); }
        .user-role { font-size: 11px; color: var(--text-light); }

        /* ─── PAGE CONTENT ─── */
        .page-content {
            padding: 28px 32px;
            flex: 1;
        }

        /* ─── SECTION HEADER ─── */
        .section-header {
            padding: 14px 20px;
            background: var(--primary);
            border-radius: 12px 12px 0 0;
            display: flex; align-items: center; gap: 10px;
        }

        .section-header h2 {
            font-size: 15px; font-weight: 700; color: white; margin: 0;
        }

        .section-header i { color: rgba(255,255,255,0.75); font-size: 15px; }

        /* ─── CARD ─── */
        .card {
            background: var(--white);
            border-radius: 0 0 12px 12px;
            box-shadow: var(--card-shadow);
            margin-bottom: 28px;
            overflow: hidden;
        }

        .card-body { padding: 24px; }

        .card-standalone {
            border-radius: 12px;
            background: var(--white);
            box-shadow: var(--card-shadow);
            margin-bottom: 28px;
            overflow: hidden;
        }

        /* ─── ALERT ─── */
        .alert-success {
            background: #ECFDF5; color: #065F46;
            border: 1px solid #A7F3D0;
            padding: 12px 16px; border-radius: 8px;
            font-size: 13.5px; font-weight: 500;
            margin-bottom: 20px;
            display: flex; align-items: center; gap: 8px;
        }

        /* ─── FORM ─── */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-group.full { grid-column: 1 / -1; }

        label {
            font-size: 13px; font-weight: 600; color: var(--text-dark);
        }

        label span.req { color: var(--danger); margin-left: 2px; }

        input[type="text"], input[type="file"], select, textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-family: inherit; font-size: 13.5px; color: var(--text-dark);
            background: var(--white);
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }

        input[type="text"]:focus,
        select:focus,
        textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79,70,229,0.1);
        }

        textarea { height: 110px; resize: vertical; }

        input[type="file"] {
            padding: 8px 12px;
            background: var(--bg);
            cursor: pointer;
        }

        .file-hint { font-size: 11.5px; color: var(--text-light); margin-top: 4px; }

        .form-actions {
            display: flex; justify-content: flex-end; gap: 10px;
            margin-top: 24px; padding-top: 20px;
            border-top: 1px solid var(--border);
        }

        .btn {
            padding: 10px 24px;
            border-radius: 8px; border: none;
            font-family: inherit; font-size: 13.5px; font-weight: 600;
            cursor: pointer; transition: all .2s;
        }

        .btn-outline {
            background: var(--white); color: var(--text-mid);
            border: 1.5px solid var(--border);
        }
        .btn-outline:hover { border-color: var(--primary); color: var(--primary); }

        .btn-primary {
            background: var(--primary); color: white;
            box-shadow: 0 2px 8px rgba(79,70,229,0.3);
        }
        .btn-primary:hover {
            background: var(--primary-dark);
            box-shadow: 0 4px 16px rgba(79,70,229,0.4);
            transform: translateY(-1px);
        }

        /* ─── TABLE ─── */
        .table-wrapper { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; }

        thead tr { border-bottom: 2px solid var(--border); }

        th {
            padding: 12px 16px;
            font-size: 12px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.6px;
            color: var(--text-light); text-align: left;
            background: #F8FAFC;
        }

        td {
            padding: 13px 16px;
            font-size: 13.5px; color: var(--text-dark);
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover td { background: #FAFBFF; }

        .img-preview {
            width: 44px; height: 44px;
            object-fit: cover; border-radius: 8px;
            border: 1.5px solid var(--border);
        }

        .no-photo {
            width: 44px; height: 44px;
            background: var(--bg); border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: var(--text-light); font-size: 18px;
            border: 1.5px dashed var(--border);
        }

        .ket-text { color: var(--text-mid); }

        /* ─── STATUS BADGES ─── */
        .badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 10px; border-radius: 20px;
            font-size: 11.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.4px;
        }

        .badge::before {
            content: ''; width: 6px; height: 6px;
            border-radius: 50%; background: currentColor;
        }

        .badge-menunggu { background: #FEF9C3; color: #A16207; }
        .badge-proses   { background: #E0F2FE; color: #0369A1; }
        .badge-selesai  { background: #DCFCE7; color: #15803D; }

        .empty-state {
            text-align: center; padding: 40px;
            color: var(--text-light); font-size: 14px;
        }

        .empty-state i { font-size: 36px; display: block; margin-bottom: 12px; opacity: .4; }
    </style>
</head>
<body>

<!-- ═══════════ SIDEBAR ═══════════ -->
<aside class="sidebar">
    <div class="sidebar-logo">
        <div class="logo-icon">A</div>
        <span class="logo-text">Aspirasi</span>
    </div>

    <nav class="sidebar-nav">
        <a href="/dashboard" class="nav-item active">
            <i class="fa-solid fa-paper-plane"></i> Input Aspirasi
        </a>
    
        <a href="/logout" class="nav-item logout" style="margin-top: 32px;">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
    </nav>

    <div class="sidebar-footer">
        Sistem Aspirasi<br>Sekolah
    </div>
</aside>

<!-- ═══════════ MAIN ═══════════ -->
<div class="main">

    <!-- TOPBAR -->
    <header class="topbar">
        <div class="topbar-title">Dashboard Siswa</div>
        <div class="topbar-right">
          
            <div class="user-pill">
                <div class="user-avatar">{{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}</div>
                <div class="user-info">
                    <div class="user-name">{{ Auth::user()->nama }}</div>
                    <div class="user-role">Siswa</div>
                </div>
            </div>
        </div>
    </header>

    <!-- PAGE CONTENT -->
    <div class="page-content">

        <!-- ── FORM KIRIM ASPIRASI ── -->
        <div class="card-standalone">
            <div class="section-header">
                <i class="fa-solid fa-paper-plane"></i>
                <h2>Kirim Aspirasi Baru</h2>
            </div>
            <div class="card-body">

                @if(session('success'))
                    <div class="alert-success">
                        <i class="fa-solid fa-circle-check"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="/aspirasi" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-grid">

                        <div class="form-group">
                            <label>Kategori Laporan <span class="req">*</span></label>
                            <select name="id_kategori" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $k)
                                    <option value="{{ $k->id_kategori }}">{{ $k->ket_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Lokasi Kejadian <span class="req">*</span></label>
                            <input type="text" name="lokasi" placeholder="Contoh: Lab Komputer, Kantin, Toilet" required>
                        </div>

                        <div class="form-group">
                            <label>Upload Foto Bukti</label>
                            <input type="file" name="foto" accept="image/*">
                            <span class="file-hint">Opsional · Format: JPG, PNG, maks. 2MB</span>
                        </div>

                        <div class="form-group full">
                            <label>Keterangan Laporan <span class="req">*</span></label>
                            <textarea name="ket" placeholder="Ceritakan detail aspirasi atau keluhanmu..." required></textarea>
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="reset" class="btn btn-outline">Reset</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-paper-plane" style="margin-right:6px;"></i>Kirim Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ── RIWAYAT ASPIRASI ── -->
        <div class="card-standalone">
            <div class="section-header">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <h2>Riwayat Aspirasi Kamu</h2>
            </div>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Foto</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Tanggapan Admin</th>
                        </tr>
                    </thead>
                   <tbody>

@forelse($riwayat as $r)
<tr>

<td>
{{ \Carbon\Carbon::parse($r->tgl_input)->format('d M Y') }}
</td>

<td>
{{ $r->kategori->ket_kategori }}
</td>

<td>
@if($r->foto)
<img src="{{ asset('uploads/'.$r->foto) }}" class="img-preview">
@else
<div class="no-photo">
<i class="fa-regular fa-image"></i>
</div>
@endif
</td>

<td class="ket-text">
{{ \Illuminate\Support\Str::limit($r->ket,55) }}
</td>

<td>

@php
$status = strtolower($r->tanggapan->status ?? 'menunggu');
@endphp

<span class="badge badge-{{ $status }}">
{{ ucfirst($status) }}
</span>

</td>

<td>

{{ $r->tanggapan->feedback ?? '-' }}

@if($r->tanggapan && $r->tanggapan->foto_tanggapan)

<br><br>

<a href="{{ asset('uploads/tanggapan/'.$r->tanggapan->foto_tanggapan) }}" target="_blank">

<img 
src="{{ asset('uploads/tanggapan/'.$r->tanggapan->foto_tanggapan) }}" 
style="width:50px;border-radius:6px;border:1px solid #ddd;">

</a>

@endif

</td>

</tr>

@empty

<tr>

<td colspan="6">

<div class="empty-state">
<i class="fa-regular fa-folder-open"></i>
Belum ada aspirasi yang dikirim.
</div>

</td>

</tr>

@endforelse

</tbody>
                </table>
            </div>
        </div>

    </div><!-- /page-content -->
</div><!-- /main -->

</body>
</html>