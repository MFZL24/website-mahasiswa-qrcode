<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Attendance System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg: #f3f4f6;
            --text-main: #111827;
            --text-muted: #6b7280;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .login-container {
            background: white;
            width: 100%;
            max-width: 450px;
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            transition: transform 0.3s ease;
        }

        .login-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .login-header .logo-icon {
            width: 60px;
            height: 60px;
            background: var(--primary);
            color: white;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin: 0 auto 20px;
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4);
        }

        .login-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 8px;
        }

        .login-header p {
            color: var(--text-muted);
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i.prefix-icon {
            position: absolute;
            left: 16px;
            color: var(--text-muted);
            transition: all 0.3s;
            font-size: 16px;
            pointer-events: none;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 15px;
            outline: none;
            transition: all 0.3s;
            background: #f9fafb;
        }

        .form-control:focus {
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .form-control:focus + i.prefix-icon {
            color: var(--primary);
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            cursor: pointer;
            color: var(--text-muted);
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }

        .password-toggle:hover {
            color: var(--primary);
        }

        .btn-login {
            width: 100%;
            background: var(--primary);
            color: white;
            padding: 14px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-login:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .error-message {
            background: #fee2e2;
            color: #dc2626;
            padding: 12px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid #fecaca;
        }

        .footer-text {
            text-align: center;
            margin-top: 30px;
            font-size: 13px;
            color: var(--text-muted);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="logo-icon">
                <i class="fa-solid fa-qrcode"></i>
            </div>
            <h1>Smart Attendance</h1>
            <p>Silakan masuk ke akun Anda</p>
        </div>

        <?php if($this->session->flashdata('error')): ?>
            <div class="error-message">
                <i class="fa-solid fa-circle-exclamation"></i> <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if($this->session->flashdata('success')): ?>
            <div style="background: #dcfce7; color: #16a34a; padding: 12px; border-radius: 10px; font-size: 14px; margin-bottom: 20px; text-align: center; border: 1px solid #bbf7d0;">
                <i class="fa-solid fa-circle-check"></i> <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('index.php/auth/proses_login') ?>" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-wrapper">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" required autocomplete="off">
                    <i class="fa-solid fa-user prefix-icon"></i>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required minlength="6">
                    <i class="fa-solid fa-lock prefix-icon"></i>
                    <span class="password-toggle" onclick="togglePasswordLogin('password')">
                        <i id="toggle-password" class="fa-solid fa-eye"></i>
                    </span>
                </div>
                <div style="text-align: right; margin-top: 5px;">
                    <a href="<?= base_url('index.php/auth/forgot_password') ?>" style="font-size: 12px; color: var(--text-muted); text-decoration: none;">Lupa Password?</a>
                </div>
            </div>

            <div style="display: flex; gap: 10px; margin-top: 10px;">
                <button type="reset" class="btn-login" style="background: #e5e7eb; color: #4b5563; flex: 1;">
                    <i class="fa-solid fa-rotate-right"></i> Reset
                </button>
                <button type="submit" class="btn-login" style="flex: 2;">
                    Sign In <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
        </form>

        <script>
            function togglePasswordLogin(id) {
                const passwordField = document.getElementById(id);
                const toggleIcon = document.getElementById('toggle-' + id);
                
                if (passwordField.type === "password") {
                    passwordField.type = "text";
                    toggleIcon.classList.remove("fa-eye");
                    toggleIcon.classList.add("fa-eye-slash");
                } else {
                    passwordField.type = "password" ;
                    toggleIcon.classList.remove("fa-eye-slash");
                    toggleIcon.classList.add("fa-eye");
                }
            }
        </script>

        <div style="margin-top: 20px; text-align: center; font-size: 14px;">
            Belum punya akun? <a href="<?= base_url('index.php/auth/register') ?>" style="color: var(--primary); text-decoration: none; font-weight: 600;">Daftar di sini</a>
        </div>

        <div class="footer-text">
            &copy; 2026 Smart Attendance System. All rights reserved.
        </div>
    </div>
</body>
</html>