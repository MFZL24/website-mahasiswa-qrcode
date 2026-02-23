<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Akun | UNIGLOBAL SISFO</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary: #006874; --primary-dark: #004f58; --light: #f0f7f8; }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Outfit',sans-serif; }
        body {
            min-height: 100vh;
            background: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .reg-card {
            width: 100%; max-width: 560px;
            background: white;
            border-radius: 28px;
            box-shadow: 0 25px 60px rgba(0,104,116,0.1);
            overflow: hidden;
        }
        .reg-header {
            background: var(--primary);
            padding: 30px 35px;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .reg-header::before {
            content: '';
            position: absolute;
            right: -30px; bottom: -40px;
            width: 150px; height: 150px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }
        .reg-header::after {
            content: '';
            position: absolute;
            right: 40px; bottom: -20px;
            width: 100px; height: 100px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }
        .reg-logo { display: flex; align-items: center; gap: 10px; font-size: 20px; font-weight: 800; margin-bottom: 15px; }
        .reg-header h1 { font-size: 26px; font-weight: 800; margin-bottom: 5px; }
        .reg-header p { font-size: 14px; opacity: 0.75; }

        .reg-body { padding: 35px; }

        .alert-msg {
            padding: 13px 16px; border-radius: 12px; font-size: 13px;
            font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;
        }
        .alert-error { background: #fff1f2; color: #e11d48; border: 1px solid #ffe4e6; }

        /* Role Selector */
        .role-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 22px; }
        .role-opt { position: relative; }
        .role-opt input { position: absolute; opacity: 0; pointer-events: none; }
        .role-label {
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            gap: 8px; padding: 18px 10px; border: 2px solid #f1f5f9; border-radius: 16px;
            cursor: pointer; transition: all 0.3s;
        }
        .role-label i { font-size: 26px; color: #94a3b8; transition: color 0.3s; }
        .role-label span { font-size: 14px; font-weight: 700; color: #64748b; transition: color 0.3s; }
        .role-opt input:checked + .role-label {
            border-color: var(--primary); background: #f0f7f8;
        }
        .role-opt input:checked + .role-label i,
        .role-opt input:checked + .role-label span { color: var(--primary); }

        .input-group { margin-bottom: 16px; }
        .input-group label {
            display: block; font-size: 12px; font-weight: 700;
            color: #475569; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 7px;
        }
        .input-field { position: relative; }
        .input-field i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 15px; }
        .input-field input {
            width: 100%; padding: 14px 16px 14px 44px;
            border: 2px solid #f1f5f9; background: #f8fafc;
            border-radius: 13px; font-size: 15px; font-weight: 600;
            transition: all 0.3s; color: #1e293b;
        }
        .input-field input:focus {
            outline: none; border-color: var(--primary);
            background: white; box-shadow: 0 0 0 4px rgba(0,104,116,0.08);
        }
        .btn-reg {
            width: 100%; padding: 16px; margin-top: 10px;
            background: var(--primary); color: white; border: none;
            border-radius: 14px; font-size: 16px; font-weight: 700; cursor: pointer;
            box-shadow: 0 10px 25px rgba(0,104,116,0.25); transition: all 0.3s;
        }
        .btn-reg:hover { background: var(--primary-dark); transform: translateY(-2px); }
        .reg-footer {
            text-align: center; margin-top: 22px; font-size: 14px; color: #64748b; font-weight: 600;
        }
        .reg-footer a { color: var(--primary); text-decoration: none; font-weight: 800; }

        @media (max-width: 480px) {
            body { padding: 12px; }
            .reg-header { padding: 25px 22px; }
            .reg-body { padding: 25px 22px; }
            .reg-header h1 { font-size: 22px; }
        }
    </style>
</head>
<body>

<div class="reg-card">
    <div class="reg-header">
        <div class="reg-logo"><i class="fa-solid fa-university"></i> UNIGLOBAL</div>
        <h1>Buat Akun Baru</h1>
        <p>Lengkapi data diri Anda untuk mendaftar ke sistem akademik.</p>
    </div>

    <div class="reg-body">
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert-msg alert-error">
                <i class="fa-solid fa-circle-exclamation"></i> <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('index.php/auth/proses_register') ?>" method="post">
            <div style="font-size: 12px; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 10px;">Saya mendaftar sebagai</div>
            <div class="role-grid">
                <div class="role-opt">
                    <input type="radio" name="role" value="mahasiswa" id="r-mhs" checked>
                    <label for="r-mhs" class="role-label">
                        <i class="fa-solid fa-user-graduate"></i>
                        <span>Mahasiswa</span>
                    </label>
                </div>
                <div class="role-opt">
                    <input type="radio" name="role" value="dosen" id="r-dosen">
                    <label for="r-dosen" class="role-label">
                        <i class="fa-solid fa-user-tie"></i>
                        <span>Dosen</span>
                    </label>
                </div>
            </div>

            <div class="input-group">
                <label id="identity-label">Nomor Induk Mahasiswa (NIM)</label>
                <div class="input-field">
                    <i class="fa-solid fa-id-card"></i>
                    <input type="text" name="identity" placeholder="Contoh: 2021001" required>
                </div>
            </div>
            <div class="input-group">
                <label>Nama Lengkap</label>
                <div class="input-field">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="nama" placeholder="Nama sesuai KTP" required>
                </div>
            </div>
            <div class="input-group">
                <label>Username</label>
                <div class="input-field">
                    <i class="fa-solid fa-at"></i>
                    <input type="text" name="username" placeholder="Buat username unik" required>
                </div>
            </div>
            <div class="input-group">
                <label>Password</label>
                <div class="input-field">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="Min. 6 karakter" required>
                </div>
            </div>

            <button type="submit" class="btn-reg">
                <i class="fa-solid fa-check"></i> BUAT AKUN SEKARANG
            </button>
        </form>

        <div class="reg-footer">
            Sudah punya akun? <a href="<?= base_url('index.php/auth/login') ?>">Login di sini</a>
            <br><br>
            <a href="<?= base_url() ?>" style="color:#94a3b8;">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Website Utama
            </a>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('input[name="role"]').forEach(el => {
        el.addEventListener('change', function() {
            const label = document.getElementById('identity-label');
            label.textContent = this.value === 'mahasiswa'
                ? 'Nomor Induk Mahasiswa (NIM)'
                : 'Nomor Induk Dosen Nasional (NIDN)';
        });
    });
</script>

</body>
</html>
