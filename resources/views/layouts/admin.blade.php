<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Panel Admin – Sistem Aspirasi</title>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<style> *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; } :root { --primary: #1E3A5F; --primary-mid: #2E5F8A; --accent: #4A9FD4; --accent-light: #E8F4FC; --success: #2ECC8F; --success-light: #E8FBF4; --warning: #F5A623; --warning-light: #FEF3E2; --danger: #E74C3C; --danger-light: #FDE8E6; --sidebar-bg: #1A2E45; --sidebar-active: #2E5F8A; --bg: #EEF4FA; --white: #FFFFFF; --border: #D8E6F0; --text-dark: #1A2E45; --text-mid: #5A7A99; --text-light: #9BB5CC; --shadow: 0 2px 12px rgba(30,58,95,0.08); } body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg); color: var(--text-dark); display: flex; min-height: 100vh; } /* ─── SIDEBAR ─── */ .sidebar { width: 210px; background: var(--sidebar-bg); min-height: 100vh; position: fixed; top: 0; left: 0; bottom: 0; display: flex; flex-direction: column; z-index: 100; } .sidebar-profile { padding: 28px 20px 20px; display: flex; flex-direction: column; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.07); text-align: center; } .avatar-ring { width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, var(--accent), #1A6FAA); display: flex; align-items: center; justify-content: center; font-size: 22px; font-weight: 800; color: white; margin-bottom: 10px; border: 3px solid rgba(74,159,212,0.4); } .profile-name { font-size: 13px; font-weight: 700; color: white; margin-bottom: 2px; } .profile-role { font-size: 11px; color: rgba(255,255,255,0.4); } .sidebar-nav { flex: 1; padding: 16px 12px; display: flex; flex-direction: column; gap: 2px; } .nav-item { display: flex; align-items: center; gap: 10px; padding: 10px 14px; border-radius: 8px; color: rgba(255,255,255,0.5); text-decoration: none; font-size: 13px; font-weight: 500; transition: all .2s; } .nav-item i { width: 16px; text-align: center; font-size: 14px; } .nav-item:hover { background: rgba(255,255,255,0.07); color: white; } .nav-item.active { background: var(--sidebar-active); color: white; } .nav-item.logout { color: #E87A70; margin-top: auto; } .nav-item.logout:hover { background: rgba(232,68,60,0.15); color: #F5A9A3; } .sidebar-bottom { padding: 16px 12px; } /* ─── MAIN ─── */ .main { margin-left: 210px; flex: 1; display: flex; flex-direction: column; } /* ─── TOPBAR ─── */ .topbar { background: var(--white); border-bottom: 1px solid var(--border); padding: 0 28px; height: 60px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 50; } .topbar-greeting { font-size: 17px; font-weight: 700; color: var(--text-dark); } .topbar-right { display: flex; align-items: center; gap: 10px; } .search-box { display: flex; align-items: center; gap: 8px; background: var(--bg); border: 1px solid var(--border); border-radius: 20px; padding: 7px 14px; font-size: 13px; color: var(--text-mid); width: 200px; } .search-box input { border: none; background: transparent; outline: none; font-family: inherit; font-size: 13px; color: var(--text-dark); width: 100%; } .icon-btn { width: 36px; height: 36px; border-radius: 8px; border: 1px solid var(--border); background: var(--white); display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--text-mid); font-size: 14px; position: relative; transition: all .2s; } .icon-btn:hover { background: var(--accent-light); color: var(--accent); } .notif-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--danger); position: absolute; top: 7px; right: 7px; border: 2px solid white; } /* ─── PAGE ─── */ .page { padding: 24px 28px; } .page-title { font-size: 13px; font-weight: 600; color: var(--text-light); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px; } /* ─── STAT CARDS ─── */ .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; } .stat-card { background: var(--white); border-radius: 14px; padding: 18px 20px; box-shadow: var(--shadow); text-decoration: none; display: flex; align-items: center; gap: 14px; transition: transform .2s, box-shadow .2s; border: 1.5px solid transparent; } .stat-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(30,58,95,0.12); } .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; } .stat-icon.gray { background: #EEF1F4; color: #7A8FA6; } .stat-icon.orange { background: var(--warning-light); color: var(--warning); } .stat-icon.blue { background: var(--accent-light); color: var(--accent); } .stat-icon.green { background: var(--success-light); color: var(--success); } .stat-card.active-all { border-color: #C0CDD8; } .stat-card.active-belum { border-color: #F5C89A; } .stat-card.active-proses { border-color: #9ACFEB; } .stat-card.active-selesai{ border-color: #8EEFC8; } .stat-num { font-size: 26px; font-weight: 800; color: var(--text-dark); line-height: 1; } .stat-label { font-size: 12px; color: var(--text-mid); margin-top: 3px; font-weight: 500; } /* ─── TABLE CARD ─── */ .table-card { background: var(--white); border-radius: 14px; box-shadow: var(--shadow); overflow: hidden; } .table-header { padding: 18px 22px; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid var(--border); } .table-header h2 { font-size: 15px; font-weight: 700; color: var(--text-dark); display: flex; align-items: center; gap: 8px; } .table-header h2 i { color: var(--accent); font-size: 14px; } .table-count { font-size: 12px; font-weight: 600; background: var(--accent-light); color: var(--accent); padding: 4px 10px; border-radius: 20px; } .table-wrapper { overflow-x: auto; } table { width: 100%; border-collapse: collapse; } thead th { padding: 12px 16px; font-size: 11.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.7px; color: var(--text-light); background: #F5F9FC; text-align: left; border-bottom: 1px solid var(--border); } tbody td { padding: 14px 16px; font-size: 13px; color: var(--text-dark); border-bottom: 1px solid #EEF4FA; vertical-align: top; } tbody tr:last-child td { border-bottom: none; } tbody tr:hover td { background: #F8FBFF; } /* student info */ .student-name { font-weight: 700; font-size: 13.5px; margin-bottom: 3px; } .student-meta { font-size: 12px; color: var(--text-mid); line-height: 1.6; } /* foto + ket */ .laporan-img { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 1.5px solid var(--border); margin-bottom: 8px; display: block; } .no-img { width: 60px; height: 60px; border-radius: 8px; background: var(--bg); display: flex; align-items: center; justify-content: center; color: var(--text-light); font-size: 20px; border: 1.5px dashed var(--border); margin-bottom: 8px; } .laporan-ket { font-size: 13px; color: var(--text-mid); max-width: 240px; line-height: 1.5; } /* status & timeline */ .badge { display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; } .badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: currentColor; } .badge-belum { background: var(--warning-light); color: #C07A10; } .badge-proses { background: var(--accent-light); color: #1A6FAA; } .badge-selesai { background: var(--success-light); color: #1A9B6A; } .timeline-item { font-size: 11.5px; color: var(--text-mid); line-height: 1.8; } /* aksi form */ .aksi-form textarea { width: 100%; min-width: 200px; padding: 8px 10px; border: 1.5px solid var(--border); border-radius: 8px; font-family: inherit; font-size: 12.5px; color: var(--text-dark); resize: vertical; height: 70px; outline: none; transition: border-color .2s; } .aksi-form textarea:focus { border-color: var(--accent); } .aksi-form textarea:disabled { background: #F5F9FC; color: var(--text-light); cursor: not-allowed; } .aksi-btns { display: flex; gap: 8px; margin-top: 8px; } .btn-aksi { flex: 1; padding: 8px 10px; border: none; border-radius: 7px; font-family: inherit; font-size: 12px; font-weight: 700; cursor: pointer; transition: all .2s; display: flex; align-items: center; justify-content: center; gap: 5px; } .btn-proses { background: var(--accent-light); color: var(--accent); border: 1.5px solid #9ACFEB; } .btn-proses:hover:not(:disabled) { background: var(--accent); color: white; } .btn-selesai { background: var(--success-light); color: #1A9B6A; border: 1.5px solid #8EEFC8; } .btn-selesai:hover:not(:disabled) { background: var(--success); color: white; } .btn-aksi:disabled { background: #F0F3F6; color: var(--text-light); border-color: var(--border); cursor: not-allowed; }
.btn-selesai:hover {
    background-color: #218838;
    transform: translateY(-1px);
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}
.empty-row td { text-align: center; padding: 48px; color: var(--text-light); font-size: 14px; } .empty-row i { font-size: 32px; display: block; margin-bottom: 10px; opacity: .4; } </style>
</head>

<body>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-profile">
        <div class="avatar-ring">A</div>
        <div class="profile-name">Administrator</div>
        <div class="profile-role">admin@sekolah.id</div>
    </div>

    <nav class="sidebar-nav">
        <a href="/admin/dashboard" class="nav-item active">
            <i class="fa-solid fa-table-columns"></i> Dashboard
        </a>

        <a href="/admin/siswa" class="nav-item {{ Request::is('admin/siswa') ? 'active' : '' }}">
            <i class="fa-solid fa-users"></i> Siswa
        </a>

    
    </nav>

    <div class="sidebar-bottom">
        <a href="/logout" class="nav-item logout">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
    </div>
</aside>


<div class="main">

<!-- TOPBAR -->
<header class="topbar">
    <div class="topbar-greeting">Selamat Datang, Admin 👋</div>

    <div class="topbar-right">
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Cari aspirasi...">
        </div>

        <div class="icon-btn">
            <i class="fa-regular fa-bell"></i>
            <span class="notif-dot"></span>
        </div>

        <div class="icon-btn">
            <i class="fa-solid fa-gear"></i>
        </div>
    </div>
</header>

<!-- CONTENT -->
<div class="page">
    @yield('content')
</div>

</div>

</body>
</html>