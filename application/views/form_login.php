<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Akademik | Login</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #006874;
            --primary-dark: #004f58;
            --secondary: #eef2ff;
            --white: #ffffff;
            --text-dark: #1e293b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--white);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: linear-gradient(135deg, #f0f7f8 0%, #ffffff 100%);
        }

        .login-container {
            display: flex;
            width: 1100px;
            height: 650px;
            background: white;
            border-radius: 40px;
            box-shadow: 0 50px 100px rgba(0, 104, 116, 0.15);
            overflow: hidden;
            border: 1px solid rgba(0, 104, 116, 0.1);
        }

        /* Left side - Information/Image */
        .login-info {
            flex: 1.2;
            background: var(--primary);
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            color: white;
            overflow: hidden;
        }

        .login-info::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://images.unsplash.com/photo-1523050335392-9bc5675e7753?auto=format&fit=crop&q=80&w=1000');
            background-size: cover;
            background-position: center;
            opacity: 0.3;
            mix-blend-mode: soft-light;
        }

        .info-content {
            position: relative;
            z-index: 10;
        }

        .info-content .logo {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .info-content h2 {
            font-size: 48px;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .info-content p {
            font-size: 18px;
            opacity: 0.9;
            line-height: 1.6;
        }

        /* Right side - Form */
        .login-form-side {
            flex: 1;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header {
            margin-bottom: 40px;
        }

        .form-header h1 {
            font-size: 32px;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .form-header p {
            color: #64748b;
            font-weight: 500;
        }

        .input-group {
            margin-bottom: 25px;
        }

        .input-group label {
            display: block;
            font-size: 14px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 18px;
        }

        .input-wrapper input {
            width: 100%;
            padding: 18px 20px 18px 55px;
            background: #f8fafc;
            border: 2px solid #f1f5f9;
            border-radius: 18px;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .input-wrapper input:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 5px rgba(0, 104, 116, 0.05);
        }

        .btn-login {
            width: 100%;
            padding: 18px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 18px;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 20px 30px rgba(0, 104, 116, 0.2);
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 25px 40px rgba(0, 104, 116, 0.3);
        }

        .register-link {
            text-align: center;
            margin-top: 35px;
            color: #64748b;
            font-weight: 600;
        }

        .register-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 800;
        }

        .error-msg {
            background: #fff1f2;
            color: #e11d48;
            padding: 15px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid #ffe4e6;
        }

        .success-msg {
            background: #ecfdf5;
            color: #059669;
            padding: 15px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 25px;
            border: 1px solid #d1fae5;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <!-- Left Side -->
        <div class="login-info">
            <div class="info-content">
                <div class="logo">
                    <i class="fa-solid fa-university"></i> UNIGLOBAL
                </div>
                <h2>Selamat Datang Kembali.</h2>
                <p>Silakan masuk ke akun Anda untuk mengakses layanan akademik, jadwal kuliah, dan sistem absensi real-time.</p>
                
                <div style="margin-top: 50px; display: flex; gap: 30px;">
                    <div>
                        <div style="font-size: 24px; font-weight: 800;">15k+</div>
                        <div style="font-size: 12px; opacity: 0.7; font-weight: 700; text-transform: uppercase;">Mahasiswa</div>
                    </div>
                    <div>
                        <div style="font-size: 24px; font-weight: 800;">500+</div>
                        <div style="font-size: 12px; opacity: 0.7; font-weight: 700; text-transform: uppercase;">Dosen Mitra</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side Form -->
        <div class="login-form-side">
            <div class="form-header">
                <h1>Masuk Sistem</h1>
                <p>Gunakan akun operator Anda untuk masuk.</p>
            </div>

            <?php if($this->session->flashdata('error')): ?>
                <div class="error-msg">
                    <i class="fa-solid fa-circle-exclamation"></i> <?= $this->session->flashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('success')): ?>
                <div class="success-msg">
                    <i class="fa-solid fa-circle-check"></i> <?= $this->session->flashdata('success') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('index.php/auth/proses_login') ?>" method="post">
                <div class="input-group">
                    <label>Username</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="username" placeholder="Masukkan username" required autocomplete="off">
                    </div>
                </div>

                <div class="input-group">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <label style="margin-bottom: 0;">Password</label>
                        <a href="<?= base_url('index.php/auth/forgot_password') ?>" style="font-size: 13px; color: var(--primary); font-weight: 700; text-decoration: none;">Lupa Password?</a>
                    </div>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" id="pass" placeholder="********" required>
                        <i class="fa-solid fa-eye" id="toggle-pass" style="left: auto; right: 20px; cursor: pointer; transition: color 0.3s;" onclick="togglePassword('pass')"></i>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    MASUK SEKARANG <i class="fa-solid fa-arrow-right-to-bracket" style="margin-left: 10px;"></i>
                </button>
            </form>

            <div class="register-link">
                Belum punya akun? <a href="<?= base_url('index.php/auth/register') ?>">Daftar di sini</a>
            </div>
            
            <div style="margin-top: 40px; text-align: center;">
                <a href="<?= base_url() ?>" style="color: #94a3b8; font-size: 14px; text-decoration: none; font-weight: 600;">
                    <i class="fa-solid fa-house"></i> Kembali ke Landing Page
                </a>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(id) {
            const passwordField = document.getElementById(id);
            const toggleIcon = document.getElementById('toggle-' + id);
            
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
                toggleIcon.style.color = "var(--primary)";
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
                toggleIcon.style.color = "#94a3b8";
            }
        }
    </script>

</body>
</html>