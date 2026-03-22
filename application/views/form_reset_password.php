<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Password | UNIKI - Universitas Kebangsaan Indonesia</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/kampus/logo.png') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #006874;
            --primary-dark: #004f58;
            --primary-light: #f0f7f8;
            --secondary: #f6b553;
            --white: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
        }

        * { margin:0; padding:0; box-sizing:border-box; font-family:'Outfit',sans-serif; }

        body {
            min-height: 100vh;
            background: #00363d url('https://images.unsplash.com/photo-1541339907198-e08756ebafe3?auto=format&fit=crop&q=80&w=1920') center/cover no-repeat fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-x: hidden;
        }

        .reset-wrapper {
            width: 100%;
            max-width: 500px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 32px;
            box-shadow: 0 40px 100px rgba(0,0,0,0.3);
            overflow: hidden;
            padding: 50px 40px;
            text-align: center;
            border: 1px solid rgba(255,255,255,0.2);
            position: relative;
        }

        .logo-container {
            display: inline-flex;
            background: white;
            padding: 15px;
            border-radius: 24px;
            width: 110px;
            height: 110px;
            align-items: center;
            justify-content: center;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            margin-bottom: 25px;
            border: 3px solid var(--primary-light);
        }
        .logo-container img { width: 100%; height: 100%; object-fit: contain; }

        .title { font-size: 30px; font-weight: 900; color: var(--text-main); margin-bottom: 10px; letter-spacing: -1px; }
        .subtitle { font-size: 15px; color: var(--text-muted); margin-bottom: 35px; line-height: 1.6; }

        .alert-msg {
            padding: 15px; border-radius: 16px; font-size: 14px; font-weight: 700;
            margin-bottom: 25px; display: flex; align-items: center; gap: 12px;
            text-align: left;
        }
        .alert-error { background: #fff1f2; color: #e11d48; border: 1px solid #ffe4e6; }
        .alert-success { background: #ecfdf5; color: #059669; border: 1px solid #d1fae5; }

        .form-group { text-align: left; margin-bottom: 22px; }
        .form-group label {
            display: block; font-size: 12px; font-weight: 800; color: #475569;
            text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;
        }
        .input-field { position: relative; }
        .input-field i.prefix {
            position: absolute; left: 18px; top: 50%; transform: translateY(-50%);
            color: #94a3b8; font-size: 18px; transition: all 0.3s;
        }
        .input-field i.suffix {
            position: absolute; right: 18px; top: 50%; transform: translateY(-50%);
            color: #94a3b8; font-size: 16px; cursor: pointer; transition: color 0.2s;
        }
        .input-field i.suffix:hover { color: var(--primary); }
        .input-field input {
            width: 100%; padding: 16px 50px 16px 54px;
            border: 2px solid #f1f5f9; background: #f8fafc;
            border-radius: 16px; font-size: 15px; font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: var(--text-main); outline: none;
        }
        .input-field input:focus {
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 5px rgba(0,104,116,0.1);
        }
        .input-field input:focus + i.prefix { color: var(--primary); }

        .btn-reset {
            width: 100%; padding: 18px; margin-top: 10px;
            background: var(--primary); color: white;
            border: none; border-radius: 16px; font-size: 16px; font-weight: 800;
            cursor: pointer; box-shadow: 0 12px 30px rgba(0,104,116,0.3);
            transition: all 0.3s; letter-spacing: 1px;
            display: flex; align-items: center; justify-content: center; gap: 12px;
        }
        .btn-reset:hover { background: var(--primary-dark); transform: translateY(-3px); box-shadow: 0 15px 40px rgba(0,104,116,0.4); }

        .security-note {
            margin-top: 30px; font-size: 13px; color: #94a3b8; font-weight: 500;
            padding: 15px; background: rgba(0,104,116,0.03); border-radius: 12px;
            border: 1px dashed rgba(0,104,116,0.1);
        }

        .back-link { margin-top: 30px; }
        .back-link a { font-size: 13px; color: #94a3b8; text-decoration: none; font-weight: 700; transition: color 0.3s; }
        .back-home a:hover { color: var(--primary); }

        /* Responsive */
        @media (max-width: 480px) {
            .reset-wrapper { padding: 40px 25px; border-radius: 24px; }
            .title { font-size: 26px; }
        }
    </style>
</head>
<body>

<div class="reset-wrapper">
    <div class="logo-container">
        <img src="<?= base_url('assets/kampus/logo.png') ?>" alt="UNIKI Logo">
    </div>

    <h1 class="title">Setup Password</h1>
    <p class="subtitle">Identitas Anda telah terverifikasi. Silakan masukkan password baru yang kuat untuk akun Anda.</p>

    <?php if($this->session->flashdata('error')): ?>
        <div class="alert-msg alert-error">
            <i class="fa-solid fa-circle-exclamation"></i> <?= $this->session->flashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('index.php/auth/update_password') ?>" method="post" id="resetForm">
        <div class="form-group">
            <label>Password Baru</label>
            <div class="input-field">
                <i class="fa-solid fa-key prefix"></i>
                <input type="password" name="password" id="reset_pass" placeholder="Minimal 6 karakter" required minlength="6">
                <i class="fa-solid fa-eye suffix" id="toggle-p1" onclick="togglePwd('reset_pass','toggle-p1')"></i>
            </div>
        </div>

        <div class="form-group">
            <label>Konfirmasi Password</label>
            <div class="input-field">
                <i class="fa-solid fa-lock-check prefix"></i>
                <input type="password" id="confirm_pass" placeholder="Ulangi password baru" required>
                <i class="fa-solid fa-eye suffix" id="toggle-p2" onclick="togglePwd('confirm_pass','toggle-p2')"></i>
            </div>
        </div>

        <button type="submit" class="btn-reset">
            <i class="fa-solid fa-save"></i> SIMPAN PASSWORD BARU
        </button>
    </form>

    <div class="security-note">
        <i class="fa-solid fa-shield-halved"></i> <b>Tips Keamanan:</b> Gunakan kombinasi huruf besar, kecil, angka, dan simbol untuk keamanan maksimal.
    </div>

    <div class="back-link">
        <a href="<?= base_url('index.php/auth/login') ?>"><i class="fa-solid fa-arrow-left"></i> Batal dan Kembali ke Login</a>
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

    document.getElementById('resetForm').onsubmit = function() {
        const p1 = document.getElementById('reset_pass').value;
        const p2 = document.getElementById('confirm_pass').value;
        if(p1 !== p2) {
            alert('Konfirmasi password tidak cocok!');
            return false;
        }
        return true;
    };
</script>

</body>
</html>
