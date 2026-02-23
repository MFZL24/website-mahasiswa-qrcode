<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | UNIGLOBAL SISFO</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #006874;
            --primary-dark: #004f58;
            --light: #f0f7f8;
        }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Outfit',sans-serif; }

        body {
            min-height: 100vh;
            background: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1050px;
            background: white;
            border-radius: 32px;
            box-shadow: 0 30px 80px rgba(0,104,116,0.12);
            overflow: hidden;
            display: flex;
            min-height: 580px;
        }

        /* Left Panel */
        .login-panel {
            flex: 1.2;
            background: var(--primary);
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
            min-height: 300px;
        }
        .login-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1523050335392-9bc5675e7753?auto=format&fit=crop&q=80&w=900') center/cover;
            opacity: 0.2;
        }
        .login-panel-content {
            position: relative;
            z-index: 2;
            color: white;
        }
        .panel-logo {
            display: flex; align-items: center; gap: 10px;
            font-size: 26px; font-weight: 800; color: white; margin-bottom: 35px;
        }
        .login-panel h2 { font-size: clamp(24px, 3vw, 36px); font-weight: 800; line-height: 1.2; margin-bottom: 15px; }
        .login-panel p { font-size: 15px; opacity: 0.8; line-height: 1.7; margin-bottom: 35px; }
        .panel-stats { display: flex; gap: 25px; }
        .panel-stat { text-align: center; }
        .panel-stat .num { font-size: 24px; font-weight: 900; }
        .panel-stat .lbl { font-size: 11px; opacity: 0.6; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }

        /* Right Panel - Form */
        .form-panel {
            flex: 1;
            padding: 50px 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-title { font-size: 28px; font-weight: 800; color: #0f172a; margin-bottom: 6px; }
        .form-sub { font-size: 14px; color: #64748b; font-weight: 500; margin-bottom: 30px; }

        .alert-msg {
            padding: 14px 18px; border-radius: 12px; font-size: 14px; font-weight: 600;
            margin-bottom: 20px; display: flex; align-items: center; gap: 10px;
        }
        .alert-error { background: #fff1f2; color: #e11d48; border: 1px solid #ffe4e6; }
        .alert-success { background: #ecfdf5; color: #059669; border: 1px solid #d1fae5; }

        .input-group { margin-bottom: 18px; }
        .input-group label {
            display: flex; justify-content: space-between; align-items: center;
            font-size: 12px; font-weight: 700; color: #475569;
            text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;
        }
        .input-group label a { color: var(--primary); text-decoration: none; font-weight: 700; font-size: 12px; }
        .input-field {
            position: relative;
        }
        .input-field i.prefix {
            position: absolute; left: 17px; top: 50%; transform: translateY(-50%);
            color: #94a3b8; font-size: 16px;
        }
        .input-field i.suffix {
            position: absolute; right: 17px; top: 50%; transform: translateY(-50%);
            color: #94a3b8; font-size: 16px; cursor: pointer; transition: color 0.2s;
        }
        .input-field i.suffix:hover { color: var(--primary); }
        .input-field input {
            width: 100%; padding: 15px 45px;
            border: 2px solid #f1f5f9;
            background: #f8fafc;
            border-radius: 14px; font-size: 15px; font-weight: 600;
            transition: all 0.3s; color: #1e293b;
        }
        .input-field input:focus {
            outline: none; border-color: var(--primary);
            background: white; box-shadow: 0 0 0 4px rgba(0,104,116,0.08);
        }

        .btn-login {
            width: 100%; padding: 16px; margin-top: 8px;
            background: var(--primary); color: white;
            border: none; border-radius: 14px; font-size: 16px; font-weight: 700;
            cursor: pointer; box-shadow: 0 10px 25px rgba(0,104,116,0.25);
            transition: all 0.3s; letter-spacing: 0.5px;
        }
        .btn-login:hover { background: var(--primary-dark); transform: translateY(-2px); box-shadow: 0 15px 35px rgba(0,104,116,0.35); }

        .divider { display: flex; align-items: center; gap: 15px; margin: 20px 0; }
        .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: #f1f5f9; }
        .divider span { font-size: 12px; color: #94a3b8; font-weight: 600; }

        .links { text-align: center; font-size: 14px; color: #64748b; font-weight: 600; }
        .links a { color: var(--primary); text-decoration: none; font-weight: 800; }

        .back-link { text-align: center; margin-top: 20px; }
        .back-link a { font-size: 13px; color: #94a3b8; text-decoration: none; font-weight: 600; }
        .back-link a:hover { color: var(--primary); }

        /* MOBILE */
        @media (max-width: 768px) {
            body { padding: 15px; align-items: flex-start; padding-top: 30px; }
            .login-wrapper { flex-direction: column; border-radius: 24px; }
            .login-panel { padding: 35px 30px; }
            .panel-stats { gap: 20px; }
            .form-panel { padding: 35px 30px; }
            .form-title { font-size: 24px; }
        }
        @media (max-width: 480px) {
            body { padding: 10px; padding-top: 15px; }
            .login-wrapper { border-radius: 20px; }
            .login-panel, .form-panel { padding: 30px 22px; }
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <!-- Left Panel -->
    <div class="login-panel">
        <div class="login-panel-content">
            <div class="panel-logo"><i class="fa-solid fa-university"></i> UNIGLOBAL</div>
            <h2>Selamat Datang Kembali!</h2>
            <p>Masuk ke sistem informasi akademik terpadu untuk mengakses jadwal, absensi, dan laporan kehadiran Anda.</p>
            <div class="panel-stats">
                <div class="panel-stat">
                    <div class="num">15k+</div>
                    <div class="lbl">Mahasiswa</div>
                </div>
                <div class="panel-stat">
                    <div class="num">500+</div>
                    <div class="lbl">Dosen</div>
                </div>
                <div class="panel-stat">
                    <div class="num">48</div>
                    <div class="lbl">Prodi</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Panel -->
    <div class="form-panel">
        <h1 class="form-title">Masuk Akun</h1>
        <p class="form-sub">Gunakan username dan password Anda.</p>

        <?php if($this->session->flashdata('error')): ?>
            <div class="alert-msg alert-error">
                <i class="fa-solid fa-circle-exclamation"></i> <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>
        <?php if($this->session->flashdata('success')): ?>
            <div class="alert-msg alert-success">
                <i class="fa-solid fa-circle-check"></i> <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('index.php/auth/proses_login') ?>" method="post">
            <div class="input-group">
                <label>Username</label>
                <div class="input-field">
                    <i class="fa-solid fa-user prefix"></i>
                    <input type="text" name="username" placeholder="Masukkan username" required autocomplete="off">
                </div>
            </div>

            <div class="input-group">
                <label>
                    Password
                    <a href="<?= base_url('index.php/auth/forgot_password') ?>">Lupa Password?</a>
                </label>
                <div class="input-field">
                    <i class="fa-solid fa-lock prefix"></i>
                    <input type="password" name="password" id="pass" placeholder="••••••••" required>
                    <i class="fa-solid fa-eye suffix" id="toggle-pass" onclick="togglePwd('pass','toggle-pass')"></i>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="fa-solid fa-right-to-bracket"></i> MASUK SEKARANG
            </button>
        </form>

        <div class="divider"><span>atau</span></div>

        <div class="links">Belum punya akun? <a href="<?= base_url('index.php/auth/register') ?>">Daftar di sini</a></div>

        <div class="back-link">
            <a href="<?= base_url() ?>"><i class="fa-solid fa-arrow-left"></i> Kembali ke Website Utama</a>
        </div>
    </div>
</div>

<script>
    function togglePwd(fieldId, iconId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(iconId);
        if (field.type === 'password') {
            field.type = 'text';
            icon.className = 'fa-solid fa-eye-slash suffix';
        } else {
            field.type = 'password';
            icon.className = 'fa-solid fa-eye suffix';
        }
    }
</script>
</body>
</html>