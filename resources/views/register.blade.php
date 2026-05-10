<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi – Sistem Aspirasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #EEEEFF;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 32px 16px;
        }

        .wrapper {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(80,60,200,0.12);
            display: flex;
            width: 860px;
            overflow: hidden;
        }

        /* ─── LEFT PANEL ─── */
        .left-panel {
            width: 300px;
            flex-shrink: 0;
            background: linear-gradient(145deg, #A8C8FF 0%, #7B6EF6 35%, #5B3FE8 60%, #3A1FCC 100%);
            padding: 36px 30px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            width: 260px; height: 260px;
            background: radial-gradient(circle, rgba(180,160,255,0.55) 0%, transparent 70%);
            top: -50px; left: -50px; border-radius: 50%;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            width: 200px; height: 200px;
            background: radial-gradient(circle, rgba(100,180,255,0.4) 0%, transparent 70%);
            bottom: 20px; right: -40px; border-radius: 50%;
        }

        .asterisk-top {
            font-size: 28px; font-weight: 800;
            color: white; opacity: .9; position: relative; z-index: 1;
        }

        .left-steps {
            position: relative; z-index: 1;
            display: flex; flex-direction: column; gap: 14px;
        }

        .step-item {
            display: flex; align-items: flex-start; gap: 12px;
        }

        .step-icon {
            width: 32px; height: 32px; border-radius: 8px;
            background: rgba(255,255,255,0.18);
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; color: white; flex-shrink: 0;
        }

        .step-text { font-size: 12.5px; color: rgba(255,255,255,0.8); line-height: 1.5; }
        .step-text strong { color: white; display: block; font-size: 13px; margin-bottom: 1px; }

        .left-bottom { position: relative; z-index: 1; }
        .left-tagline { font-size: 11.5px; color: rgba(255,255,255,0.6); margin-bottom: 8px; }
        .left-title { font-size: 19px; font-weight: 800; color: white; line-height: 1.3; }

        /* ─── RIGHT PANEL ─── */
        .right-panel {
            flex: 1;
            padding: 36px 40px;
            display: flex; flex-direction: column; justify-content: center;
        }

        .right-asterisk {
            font-size: 20px; font-weight: 800; color: #5B3FE8; margin-bottom: 8px;
        }

        .right-panel h1 {
            font-size: 23px; font-weight: 800; color: #111; margin-bottom: 5px;
        }

        .subtitle {
            font-size: 12.5px; color: #999; line-height: 1.6; margin-bottom: 22px;
        }

        /* ─── ALERT ─── */
        .alert-error {
            background: #FDE8E8; color: #C0392B;
            border: 1px solid #F5AEAE;
            padding: 10px 14px; border-radius: 10px;
            font-size: 12.5px; font-weight: 500;
            margin-bottom: 16px;
            display: flex; align-items: center; gap: 8px;
        }

        /* ─── FORM GRID ─── */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px 16px;
        }

        .form-group { display: flex; flex-direction: column; gap: 5px; }
        .form-group.full { grid-column: 1 / -1; }

        label {
            font-size: 12.5px; font-weight: 600; color: #333;
        }

        .input-wrap { position: relative; }

        .input-wrap input {
            width: 100%;
            padding: 10px 13px;
            border: 1.5px solid #DDD;
            border-radius: 9px;
            font-family: inherit; font-size: 13px; color: #222;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        .input-wrap input:focus {
            border-color: #5B3FE8;
            box-shadow: 0 0 0 3px rgba(91,63,232,0.09);
        }

        .input-wrap input.error-input { border-color: #E74C3C; }

        .toggle-pw {
            position: absolute; right: 12px; top: 50%;
            transform: translateY(-50%);
            color: #BBB; cursor: pointer; font-size: 13px;
            transition: color .2s;
        }
        .toggle-pw:hover { color: #5B3FE8; }

        .field-error {
            font-size: 11px; color: #E74C3C; font-weight: 500;
        }

        /* ─── SUBMIT ─── */
        .btn-submit {
            width: 100%; padding: 12px;
            background: #5B3FE8; color: white;
            border: none; border-radius: 10px;
            font-family: inherit; font-size: 13.5px; font-weight: 700;
            cursor: pointer; margin-top: 18px;
            transition: background .2s, transform .15s, box-shadow .2s;
            box-shadow: 0 4px 16px rgba(91,63,232,0.32);
        }

        .btn-submit:hover {
            background: #4A30CC;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(91,63,232,0.42);
        }

        .form-footer {
            text-align: center; font-size: 12.5px; color: #999; margin-top: 16px;
        }

        .form-footer a {
            color: #5B3FE8; font-weight: 600; text-decoration: none;
        }

        .form-footer a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="wrapper">

    <!-- LEFT -->
    <div class="left-panel">
        <div class="asterisk-top">✳</div>

        <div class="left-steps">
            <div class="step-item">
                <div class="step-icon"><i class="fa-solid fa-id-card"></i></div>
                <div class="step-text">
                    <strong>Isi Data Diri</strong>
                    Masukkan NIS, NISN, nama, dan kelas kamu
                </div>
            </div>
            <div class="step-item">
                <div class="step-icon"><i class="fa-solid fa-envelope"></i></div>
                <div class="step-text">
                    <strong>Daftarkan Email</strong>
                    Gunakan Gmail aktif untuk login
                </div>
            </div>
            <div class="step-item">
                <div class="step-icon"><i class="fa-solid fa-paper-plane"></i></div>
                <div class="step-text">
                    <strong>Mulai Aspirasi</strong>
                    Sampaikan laporan dan keluhanmu
                </div>
            </div>
        </div>

        <div class="left-bottom">
            <div class="left-tagline">Bergabung sekarang</div>
            <div class="left-title">Buat akun dan<br>mulai aspirasi<br>pertamamu</div>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="right-panel">
        <div class="right-asterisk">✳</div>
        <h1>Buat Akun Baru</h1>
        <p class="subtitle">Isi data di bawah untuk mendaftarkan akun siswa kamu.</p>

        @if(session('error'))
            <div class="alert-error">
                <i class="fa-solid fa-circle-exclamation"></i>
                {{ session('error') }}
            </div>
        @endif

        <form action="/register" method="POST">
            @csrf
            <div class="form-grid">

                <div class="form-group">
                    <label>NIS <span style="color:#E74C3C">*</span></label>
                    <div class="input-wrap">
                        <input type="number" name="nis" required placeholder="Nomor Induk Siswa"
                            value="{{ old('nis') }}"
                            class="{{ $errors->has('nis') ? 'error-input' : '' }}">
                    </div>
                    @error('nis')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label>NISN <span style="color:#E74C3C">*</span></label>
                    <div class="input-wrap">
                        <input type="number" name="nisn" required placeholder="Nomor Induk Nasional"
                            value="{{ old('nisn') }}"
                            class="{{ $errors->has('nisn') ? 'error-input' : '' }}">
                    </div>
                    @error('nisn')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group full">
                    <label>Nama Lengkap <span style="color:#E74C3C">*</span></label>
                    <div class="input-wrap">
                        <input type="text" name="nama" required placeholder="Nama sesuai absen"
                            value="{{ old('nama') }}"
                            class="{{ $errors->has('nama') ? 'error-input' : '' }}">
                    </div>
                    @error('nama')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label>Kelas <span style="color:#E74C3C">*</span></label>
                    <div class="input-wrap">
                        <input type="text" name="kelas" required placeholder="Contoh: XII-RPL-1"
                            value="{{ old('kelas') }}"
                            class="{{ $errors->has('kelas') ? 'error-input' : '' }}">
                    </div>
                    @error('kelas')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label>Gmail <span style="color:#E74C3C">*</span></label>
                    <div class="input-wrap">
                        <input type="email" name="gmail" required placeholder="emailkamu@gmail.com"
                            value="{{ old('gmail') }}"
                            class="{{ $errors->has('gmail') ? 'error-input' : '' }}">
                    </div>
                    @error('gmail')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group full">
                    <label>Password <span style="color:#E74C3C">*</span></label>
                    <div class="input-wrap">
                        <input type="password" name="password" id="pwInput" required placeholder="Minimal 6 karakter"
                            class="{{ $errors->has('password') ? 'error-input' : '' }}">
                        <span class="toggle-pw" onclick="togglePw()">
                            <i class="fa-regular fa-eye" id="eyeIcon"></i>
                        </span>
                    </div>
                    @error('password')<span class="field-error">{{ $message }}</span>@enderror
                </div>

            </div>

            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-user-plus" style="margin-right:6px;"></i>Daftar Sekarang
            </button>
        </form>

        <div class="form-footer">
            Sudah punya akun? <a href="/login">Masuk di sini</a>
        </div>
    </div>

</div>

<script>
    function togglePw() {
        const input = document.getElementById('pwInput');
        const icon  = document.getElementById('eyeIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'fa-regular fa-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'fa-regular fa-eye';
        }
    }
</script>

</body>
</html>