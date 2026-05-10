<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – Sistem Aspirasi</title>
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
        }

        /* ─── WRAPPER ─── */
        .wrapper {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(80, 60, 200, 0.12);
            display: flex;
            width: 820px;
            min-height: 500px;
            overflow: hidden;
        }

        /* ─── LEFT PANEL ─── */
        .left-panel {
            width: 320px;
            flex-shrink: 0;
            background: linear-gradient(145deg, #A8C8FF 0%, #7B6EF6 35%, #5B3FE8 60%, #3A1FCC 100%);
            padding: 32px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        /* subtle radial glow blobs */
        .left-panel::before {
            content: '';
            position: absolute;
            width: 260px; height: 260px;
            background: radial-gradient(circle, rgba(180,160,255,0.55) 0%, transparent 70%);
            top: -40px; left: -40px;
            border-radius: 50%;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            width: 200px; height: 200px;
            background: radial-gradient(circle, rgba(100,180,255,0.45) 0%, transparent 70%);
            bottom: 30px; right: -30px;
            border-radius: 50%;
        }

        .asterisk-top {
            font-size: 28px; font-weight: 800; color: white;
            opacity: 0.9; position: relative; z-index: 1;
        }

        .left-bottom { position: relative; z-index: 1; }

        .left-tagline {
            font-size: 11.5px; font-weight: 500;
            color: rgba(255,255,255,0.65);
            margin-bottom: 10px;
        }

        .left-title {
            font-size: 22px; font-weight: 800;
            color: white; line-height: 1.3;
        }

        /* ─── RIGHT PANEL ─── */
        .right-panel {
            flex: 1;
            padding: 40px 44px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right-asterisk {
            font-size: 22px; font-weight: 800; color: #5B3FE8;
            margin-bottom: 10px;
        }

        .right-panel h1 {
            font-size: 26px; font-weight: 800; color: #111;
            margin-bottom: 8px; line-height: 1.2;
        }

        .right-panel .subtitle {
            font-size: 13px; color: #888; line-height: 1.6;
            margin-bottom: 28px;
        }

        /* ─── ALERT ─── */
        .alert-error {
            background: #FDE8E8; color: #C0392B;
            border: 1px solid #F5AEAE;
            padding: 11px 14px; border-radius: 10px;
            font-size: 13px; font-weight: 500;
            margin-bottom: 20px;
            display: flex; align-items: center; gap: 8px;
        }

        /* ─── FORM ─── */
        .form-group { margin-bottom: 18px; }

        .form-group label {
            display: block;
            font-size: 13px; font-weight: 600; color: #222;
            margin-bottom: 7px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap input {
            width: 100%;
            padding: 12px 14px;
            border: 1.5px solid #DDD;
            border-radius: 10px;
            font-family: inherit; font-size: 13.5px; color: #222;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        .input-wrap input:focus {
            border-color: #5B3FE8;
            box-shadow: 0 0 0 3px rgba(91,63,232,0.1);
        }

        .toggle-pw {
            position: absolute; right: 13px; top: 50%;
            transform: translateY(-50%);
            color: #AAA; cursor: pointer; font-size: 14px;
            transition: color .2s;
        }
        .toggle-pw:hover { color: #5B3FE8; }

        /* ─── SUBMIT ─── */
        .btn-submit {
            width: 100%;
            padding: 13px;
            background: #5B3FE8;
            color: white; border: none; border-radius: 10px;
            font-family: inherit; font-size: 14px; font-weight: 700;
            cursor: pointer; margin-top: 4px;
            transition: background .2s, transform .15s, box-shadow .2s;
            box-shadow: 0 4px 16px rgba(91,63,232,0.35);
        }

        .btn-submit:hover {
            background: #4A30CC;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(91,63,232,0.45);
        }

        /* ─── DIVIDER ─── */
        .divider {
            display: flex; align-items: center; gap: 10px;
            margin: 20px 0; color: #BBB; font-size: 12px;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1; height: 1px; background: #E5E5E5;
        }

        /* ─── SOCIAL ─── */
        .social-row {
            display: flex; gap: 10px; margin-bottom: 24px;
        }

        .btn-social {
            flex: 1; padding: 10px;
            border: 1.5px solid #E0E0E0; border-radius: 10px;
            background: white; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; color: #555;
            transition: border-color .2s, background .2s;
        }

        .btn-social:hover { border-color: #5B3FE8; background: #F0EDFF; color: #5B3FE8; }

        /* ─── FOOTER TEXT ─── */
        .form-footer {
            text-align: center; font-size: 13px; color: #888;
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
        <div class="left-bottom">
            <div class="left-tagline">Kamu bisa dengan mudah</div>
            <div class="left-title">Sampaikan aspirasi<br>dan keluhanmu<br>dengan mudah</div>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="right-panel">
        <div class="right-asterisk">✳</div>
        <h1>Masuk ke Akun</h1>
        <p class="subtitle">Akses dan kelola aspirasi sekolahmu kapan saja,<br>di mana saja — satu tempat untuk semua laporan.</p>

        @if(session('error'))
            <div class="alert-error">
                <i class="fa-solid fa-circle-exclamation"></i>
                {{ session('error') }}
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf

            <div class="form-group">
                <label>Email kamu</label>
                <div class="input-wrap">
                    <input type="email" name="gmail" required placeholder="emailkamu@gmail.com">
                </div>
            </div>

            <div class="form-group">
                <label>Password</label>
                <div class="input-wrap">
                    <input type="password" name="password" id="pwInput" required placeholder="••••••••••">
                    <span class="toggle-pw" onclick="togglePw()">
                        <i class="fa-regular fa-eye" id="eyeIcon"></i>
                    </span>
                </div>
            </div>

            <button type="submit" class="btn-submit">Masuk</button>
        </form>

        <div class="divider"></div>

        <div class="form-footer">
            Belum punya akun? <a href="/register">Daftar di sini</a>
        </div>
    </div>

</div>

<script>
    function togglePw() {
        const input = document.getElementById('pwInput');
        const icon = document.getElementById('eyeIcon');
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