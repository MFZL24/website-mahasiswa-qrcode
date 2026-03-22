<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <title>Login | UNIKI ABSENSI - Sistem Digital Terpadu</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/kampus/logo.png') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #006874;
            --primary-dark: #004f58;
            --primary-light: #e0f2f1;
            --secondary: #f6b553;
            --white: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
        }

        * { margin:0; padding:0; box-sizing:border-box; font-family:'Outfit',sans-serif; -webkit-tap-highlight-color: transparent; }
        
        a { text-decoration: none; color: inherit; }

        body {
            min-height: 100vh;
            background: #00363d url('https://images.unsplash.com/photo-1541339907198-e08756ebafe3?auto=format&fit=crop&q=80&w=1920') center/cover no-repeat fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1050px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 40px;
            box-shadow: 0 40px 100px rgba(0,0,0,0.3);
            overflow: hidden;
            display: flex;
            min-height: 620px;
            border: 1px solid rgba(255,255,255,0.3);
        }

        /* Left Panel */
        .login-panel {
            flex: 1.3;
            background: var(--primary);
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        .login-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 104, 116, 0.92), rgba(0, 79, 88, 0.98));
            z-index: 1;
        }
        .login-panel-content {
            position: relative;
            z-index: 2;
            color: white;
        }
        
        .brand-container {
            display: flex;
            align-items: center;
            gap: 25px;
            margin-bottom: 50px;
        }
        
        .logo-box {
            background: white;
            padding: 15px;
            border-radius: 28px;
            width: 110px;
            height: 110px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            border: 4px solid rgba(255,255,255,0.2);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .logo-box:hover { transform: scale(1.05) rotate(-5deg); }
        .logo-box img { width: 100%; height: 100%; object-fit: contain; }

        .brand-text h1 { font-size: 38px; font-weight: 900; letter-spacing: 2px; line-height: 1; margin-bottom: 5px; }
        .brand-text p { font-size: 13px; font-weight: 600; opacity: 0.8; text-transform: uppercase; letter-spacing: 2px; }

        .login-panel h2 { font-size: clamp(28px, 4vw, 42px); font-weight: 800; line-height: 1.1; margin-bottom: 20px; letter-spacing: -1px; }
        .login-panel p.desc { font-size: 16px; opacity: 0.85; line-height: 1.7; margin-bottom: 45px; max-width: 450px; }

        .panel-stats { display: flex; gap: 35px; border-top: 1px solid rgba(255,255,255,0.15); padding-top: 35px; }
        .panel-stat .num { font-size: 28px; font-weight: 900; color: var(--secondary); display: block; margin-bottom: 5px; }
        .panel-stat .lbl { font-size: 12px; opacity: 0.6; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; }

        /* Right Panel - Form */
        .form-panel {
            flex: 1;
            padding: 60px 55px;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-header { margin-bottom: 35px; }
        .form-title { font-size: 32px; font-weight: 900; color: #0f172a; margin-bottom: 8px; letter-spacing: -0.5px; }
        .form-sub { font-size: 15px; color: #64748b; font-weight: 500; }

        .alert-msg {
            padding: 16px 20px; border-radius: 16px; font-size: 14px; font-weight: 700;
            margin-bottom: 25px; display: flex; align-items: center; gap: 12px;
        }
        .alert-error { background: #fff1f2; color: #e11d48; border: 1px solid #ffe4e6; }
        .alert-success { background: #ecfdf5; color: #059669; border: 1px solid #d1fae5; }

        .input-group { margin-bottom: 22px; }
        .input-group label {
            display: flex; justify-content: space-between; align-items: center;
            font-size: 13px; font-weight: 800; color: #475569;
            text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;
        }
        .input-group label a { color: var(--primary); text-decoration: none; font-weight: 700; font-size: 12px; border-bottom: 2px solid transparent; transition: all 0.3s; }
        .input-group label a:hover { border-color: var(--primary); }
        
        .input-field { position: relative; }
        .input-field i.prefix {
            position: absolute; left: 18px; top: 50%; transform: translateY(-50%);
            color: #94a3b8; font-size: 18px; transition: all 0.3s;
        }
        .input-field i.suffix {
            position: absolute; right: 18px; top: 50%; transform: translateY(-50%);
            color: #94a3b8; font-size: 18px; cursor: pointer; transition: all 0.3s;
        }
        .input-field i.suffix:hover { color: var(--primary); }
        
        .input-field input {
            width: 100%; padding: 18px 50px 18px 54px;
            border: 2px solid #f1f5f9; background: #f8fafc;
            border-radius: 18px; font-size: 16px; font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); color: #1e293b;
        }
        .input-field input:focus {
            outline: none; border-color: var(--primary);
            background: white; box-shadow: 0 0 0 5px rgba(0,104,116,0.08);
        }
        .input-field input:focus + i.prefix { color: var(--primary); }

        .btn-login {
            width: 100%; padding: 18px; margin-top: 15px;
            background: var(--primary); color: white;
            border: none; border-radius: 18px; font-size: 17px; font-weight: 800;
            cursor: pointer; box-shadow: 0 12px 30px rgba(0,104,116,0.3);
            transition: all 0.3s; letter-spacing: 1px;
            display: flex; align-items: center; justify-content: center; gap: 12px;
        }
        .btn-login:hover { background: var(--primary-dark); transform: translateY(-3px); box-shadow: 0 15px 40px rgba(0,104,116,0.4); }

        .divider { display: flex; align-items: center; gap: 15px; margin: 30px 0; }
        .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: #f1f5f9; }
        .divider span { font-size: 13px; color: #94a3b8; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }

        .links { text-align: center; font-size: 15px; color: #64748b; font-weight: 600; }
        .links a { color: var(--primary); text-decoration: none; font-weight: 800; border-bottom: 2px solid transparent; transition: all 0.3s; }
        .links a:hover { border-color: var(--primary); }

        .back-link { text-align: center; margin-top: 30px; }
        .back-link a { font-size: 14px; color: #94a3b8; text-decoration: none; font-weight: 700; transition: color 0.3s; }
        .back-link a:hover { color: var(--primary); }

        /* MOBILE */
        @media (max-width: 991px) {
            .login-wrapper { max-width: 600px; flex-direction: column; border-radius: 32px; min-height: auto; }
            .login-panel { padding: 45px 40px; min-height: 250px; }
            .brand-container { margin-bottom: 20px; }
            .panel-stats { display: none; }
            .login-panel p.desc { display: none; }
            .login-panel h2 { font-size: 24px; margin-bottom: 0; }
            .form-panel { padding: 45px 40px; }
        }
        @media (max-width: 768px) {
            body { padding: 0; background-attachment: scroll; }
            .login-wrapper { border-radius: 0; border: none; }
            .login-panel { padding: 40px 25px; border-radius: 0; }
            .form-panel { padding: 40px 25px; border-radius: 0; }
            .form-title { font-size: 26px; }
            .form-header { margin-bottom: 25px; }
            .input-field input { padding: 15px 45px 15px 50px; font-size: 15px; }
            .btn-login { padding: 16px; font-size: 16px; }
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <!-- Left Panel -->
    <div class="login-panel">
        <div class="login-panel-content">
            <div class="brand-container">
                <div class="logo-box">
                    <img src="<?= base_url('assets/kampus/logo.png') ?>" alt="UNIKI Logo">
                </div>
                <div class="brand-text">
                    <h1>ABSENSI</h1>
                    <p>Digital UNIKI</p>
                </div>
            </div>
            
            <h2>Sistem Absensi Digital Terpadu</h2>
            <p class="desc">Masuk ke platform digital UNIKI untuk akses monitoring kehadiran, laporan real-time, dan manajemen akademik dengan teknologi QR-Code.</p>
            
            <div class="panel-stats">
                <div class="panel-stat">
                    <span class="num">12k+</span>
                    <span class="lbl">Mahasiswa</span>
                </div>
                <div class="panel-stat">
                    <span class="num">450+</span>
                    <span class="lbl">Dosen</span>
                </div>
                <div class="panel-stat">
                    <span class="num">32</span>
                    <span class="lbl">Prodi</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Panel -->
    <div class="form-panel">
        <div class="form-header">
            <h1 class="form-title">Masuk Akun</h1>
            <p class="form-sub">Gunakan kredensial Anda untuk melanjutkan.</p>
        </div>

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
                    <i class="fa-solid fa-user-tag prefix"></i>
                    <input type="text" name="username" placeholder="Masukkan username" required autocomplete="off">
                </div>
            </div>

            <div class="input-group">
                <label>
                    Password
                    <a href="<?= base_url('index.php/auth/forgot_password') ?>">Lupa Password?</a>
                </label>
                <div class="input-field">
                    <i class="fa-solid fa-shield-keyhole prefix"></i>
                    <input type="password" name="password" id="pass" placeholder="••••••••" required>
                    <i class="fa-regular fa-eye suffix" id="toggle-pass" onclick="togglePwd('pass','toggle-pass')"></i>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="fa-solid fa-right-to-bracket"></i> MASUK SEKARANG
            </button>
        </form>

        <div class="divider"><span>atau</span></div>

        <div class="links">Belum punya akun? <a href="<?= base_url('index.php/auth/register') ?>">Daftar di sini</a></div>

        <!-- Registration Status Check -->
        <div style="margin-top: 35px; background: #f8fafc; padding: 25px; border-radius: 25px; border: 1.5px dashed #e2e8f0;">
            <p style="font-size: 13px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; text-align: center;">Cek Status Pendaftaran</p>
            <form action="<?= base_url('index.php/auth/cek_status') ?>" method="post" style="display: flex; gap: 10px;">
                <input type="text" name="identity" placeholder="Masukkan NIM / NIDN" style="flex: 1; padding: 12px 18px; border-radius: 12px; border: 2px solid #fff; background: white; font-size: 14px; font-weight: 600; outline: none; transition: border-color 0.3s;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='#fff'" required>
                <button type="submit" style="background: var(--primary); color: white; border: none; padding: 0 20px; border-radius: 12px; cursor: pointer; transition: all 0.3s;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>

        <div class="back-link">
            <a href="<?= base_url() ?>"><i class="fa-solid fa-arrow-left-long"></i> Kembali ke Website Utama</a>
        </div>
    </div>
</div>

<script>
    function togglePwd(fieldId, iconId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(iconId);
        if (field.type === 'password') {
            field.type = 'text';
            icon.className = 'fa-regular fa-eye-slash suffix';
        } else {
            field.type = 'password';
            icon.className = 'fa-regular fa-eye suffix';
        }
    }
</script>
</body>
</html>