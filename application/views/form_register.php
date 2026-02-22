<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Attendance System</title>
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
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }
        .register-container {
            background: white;
            width: 100%;
            max-width: 550px;
            padding: 40px;
            border-radius: 30px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { font-size: 26px; font-weight: 800; color: var(--text-main); letter-spacing: -0.5px; }
        .header p { color: var(--text-muted); font-size: 15px; margin-top: 5px; }
        
        .role-selector {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 30px;
            background: #f1f5f9;
            padding: 8px;
            border-radius: 16px;
        }
        .role-option {
            padding: 12px;
            text-align: center;
            cursor: pointer;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.3s;
            color: #64748b;
        }
        .role-option.active {
            background: white;
            color: var(--primary);
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; }
        
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
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            font-size: 15px;
            outline: none;
            transition: all 0.3s;
            background: #fff;
        }
        .form-control:focus { 
            border-color: var(--primary); 
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
        }

        .btn-register {
            width: 100%;
            background: var(--primary);
            color: white;
            padding: 16px;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
        }
        .btn-register:hover {
            transform: translateY(-2px);
            background: var(--primary-hover);
        }

        .footer-text { text-align: center; margin-top: 30px; font-size: 14px; color: var(--text-muted); }
        .footer-text a { color: var(--primary); text-decoration: none; font-weight: 700; }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="header">
            <h1>Daftar Akun Baru</h1>
            <p>Pilih peran Anda untuk memulai</p>
        </div>

        <div class="role-selector">
            <div class="role-option active" id="opt-mhs" onclick="switchRole('mahasiswa')">
                <i class="fa-solid fa-user-graduate"></i> Mahasiswa
            </div>
            <div class="role-option" id="opt-dosen" onclick="switchRole('dosen')">
                <i class="fa-solid fa-user-tie"></i> Dosen
            </div>
        </div>

        <form action="<?= base_url('index.php/auth/proses_register') ?>" method="post">
            <input type="hidden" name="role" id="role-input" value="mahasiswa">
            
            <div class="form-group" id="group-id">
                <label id="label-id">NIM (Nomor Induk Mahasiswa)</label>
                <div class="input-wrapper">
                    <input type="text" name="identity" id="input-id" class="form-control" placeholder="Masukkan NIM Anda" required>
                    <i class="fa-solid fa-id-card prefix-icon"></i>
                </div>
            </div>

            <div class="form-group">
                <label>Nama Lengkap</label>
                <div class="input-wrapper">
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama sesuai KTP" required>
                    <i class="fa-solid fa-user prefix-icon"></i>
                </div>
            </div>

            <div class="form-group" id="group-extra">
                <label>Username</label>
                <div class="input-wrapper">
                    <input type="text" name="username" class="form-control" placeholder="Buat username unik" required>
                    <i class="fa-solid fa-at prefix-icon"></i>
                </div>
            </div>

            <div class="form-group">
                <label>Password Akun</label>
                <div class="input-wrapper">
                    <input type="password" name="password" id="reg_pass" class="form-control" placeholder="Minimal 6 karakter" required minlength="6">
                    <i class="fa-solid fa-lock prefix-icon"></i>
                    <span class="password-toggle" onclick="togglePasswordReg('reg_pass')">
                        <i id="toggle-reg_pass" class="fa-solid fa-eye"></i>
                    </span>
                </div>
            </div>
            
            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="reset" class="btn-register" style="background: #e2e8f0; color: #475569; flex: 1; box-shadow: none; margin-top: 0;">
                    Reset
                </button>
                <button type="submit" class="btn-register" style="flex: 2; margin-top: 0;">
                    DAFTAR SEKARANG
                </button>
            </div>
        </form>

        <div class="footer-text">
            Sudah punya akun? <a href="<?= base_url('index.php/auth/login') ?>">Masuk di sini</a>
        </div>
    </div>

    <script>
        function switchRole(role) {
            document.getElementById('role-input').value = role;
            const optMhs = document.getElementById('opt-mhs');
            const optDosen = document.getElementById('opt-dosen');
            const labelId = document.getElementById('label-id');
            const inputId = document.getElementById('input-id');

            if (role === 'mahasiswa') {
                optMhs.classList.add('active');
                optDosen.classList.remove('active');
                labelId.innerText = 'NIM (Nomor Induk Mahasiswa)';
                inputId.placeholder = 'Masukkan NIM Anda';
            } else {
                optDosen.classList.add('active');
                optMhs.classList.remove('active');
                labelId.innerText = 'NIDN (Nomor Induk Dosen)';
                inputId.placeholder = 'Masukkan NIDN Anda';
            }
        }

        function togglePasswordReg(id) {
            const passwordField = document.getElementById(id);
            const toggleIcon = document.getElementById('toggle-' + id);
            
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>
