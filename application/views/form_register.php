<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Akun Baru | UNIGLOBAL</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #006874;
            --primary-dark: #004f58;
            --bg: #f8fafc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 0;
            background: radial-gradient(circle at top right, #f0f7f8, #ffffff);
        }

        .reg-container {
            width: 100%;
            max-width: 600px;
            background: white;
            padding: 50px;
            border-radius: 40px;
            box-shadow: 0 40px 80px rgba(0, 104, 116, 0.1);
            border: 1px solid rgba(0, 104, 116, 0.05);
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo {
            font-size: 28px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 20px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .header h1 {
            font-size: 28px;
            color: #1e293b;
            font-weight: 800;
        }

        .header p {
            color: #64748b;
            margin-top: 10px;
            font-weight: 500;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #475569;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        .input-wrapper input, .input-wrapper select {
            width: 100%;
            padding: 15px 20px 15px 50px;
            border: 2px solid #f1f5f9;
            background: #f8fafc;
            border-radius: 15px;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .input-wrapper input:focus, .input-wrapper select:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(0, 104, 116, 0.05);
        }

        .btn-reg {
            width: 100%;
            padding: 18px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 18px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 15px 25px rgba(0, 104, 116, 0.2);
            transition: all 0.3s;
            margin-top: 20px;
        }

        .btn-reg:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .footer-links {
            text-align: center;
            margin-top: 30px;
            color: #64748b;
            font-weight: 600;
            font-size: 14px;
        }

        .footer-links a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 800;
        }
        
        .role-selector {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 25px;
        }

        .role-option {
            border: 2px solid #f1f5f9;
            padding: 15px;
            border-radius: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }

        .role-option input {
            position: absolute;
            opacity: 0;
        }

        .role-option i {
            font-size: 24px;
            display: block;
            margin-bottom: 8px;
            color: #94a3b8;
        }

        .role-option span {
            font-size: 14px;
            font-weight: 700;
            color: #64748b;
        }

        .role-option:has(input:checked) {
            border-color: var(--primary);
            background: #f0f7f8;
        }

        .role-option:has(input:checked) i, .role-option:has(input:checked) span {
            color: var(--primary);
        }
    </style>
</head>
<body>

    <div class="reg-container">
        <div class="header">
            <div class="logo"><i class="fa-solid fa-university"></i> UNIGLOBAL</div>
            <h1>Daftar Akun Baru</h1>
            <p>Silakan lengkapi data diri Anda untuk mendaftar.</p>
        </div>

        <?php if($this->session->flashdata('error')): ?>
            <div style="background: #fff1f2; color: #e11d48; padding: 15px; border-radius: 12px; font-size: 14px; font-weight: 600; margin-bottom: 25px; border: 1px solid #ffe4e6;">
                <i class="fa-solid fa-circle-exclamation"></i> <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('index.php/auth/proses_register') ?>" method="post">
            
            <label style="display: block; font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 12px; text-transform: uppercase;">Pilih Peran Anda</label>
            <div class="role-selector">
                <label class="role-option">
                    <input type="radio" name="role" value="mahasiswa" checked required id="role-mhs">
                    <i class="fa-solid fa-user-graduate"></i>
                    <span>Mahasiswa</span>
                </label>
                <label class="role-option">
                    <input type="radio" name="role" value="dosen" id="role-dosen">
                    <i class="fa-solid fa-user-tie"></i>
                    <span>Dosen</span>
                </label>
            </div>

            <div class="input-group">
                <label id="identity-label">Nomor Induk Mahasiswa (NIM)</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-id-card"></i>
                    <input type="text" name="identity" placeholder="Contoh: 2021001" required>
                </div>
            </div>

            <div class="input-group">
                <label>Nama Lengkap</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="nama" placeholder="Masukkan nama lengkap" required>
                </div>
            </div>

            <div class="input-group">
                <label>Username</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-at"></i>
                    <input type="text" name="username" placeholder="Buat username unik" required>
                </div>
            </div>

            <div class="input-group">
                <label>Password</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="********" required>
                </div>
            </div>

            <button type="submit" class="btn-reg">BUAT AKUN SEKARANG</button>
        </form>

        <div class="footer-links">
            Sudah punya akun? <a href="<?= base_url('index.php/auth/login') ?>">Login di sini</a>
            <br><br>
            <a href="<?= base_url() ?>" style="color: #94a3b8; font-weight: 600;">Kembali ke Beranda</a>
        </div>
    </div>

    <script>
        document.getElementById('role-mhs').addEventListener('change', function() {
            document.getElementById('identity-label').innerText = 'Nomor Induk Mahasiswa (NIM)';
        });
        document.getElementById('role-dosen').addEventListener('change', function() {
            document.getElementById('identity-label').innerText = 'Nomor Induk Dosen Nasional (NIDN)';
        });
    </script>

</body>
</html>
