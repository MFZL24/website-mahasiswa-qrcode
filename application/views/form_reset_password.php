<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Attendance System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary: #10b981; --bg: #f3f4f6; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background: linear-gradient(135deg, #10b981 0%, #059669 100%); height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .card { background: white; width: 100%; max-width: 450px; padding: 40px; border-radius: 24px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); }
        .header { text-align: center; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; }
        .form-control { width: 100%; padding: 12px 15px; border: 2px solid #e5e7eb; border-radius: 12px; font-size: 14px; outline: none; }
        .btn-submit { width: 100%; background: var(--primary); color: white; padding: 14px; border: none; border-radius: 12px; font-size: 16px; font-weight: 600; cursor: pointer; }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <h1 style="color: #059669;">Setup Password Baru</h1>
            <p style="color: #666; font-size: 14px; margin-top: 5px;">Data terverifikasi! Masukkan password baru.</p>
        </div>

        <form action="<?= base_url('index.php/auth/update_password') ?>" method="post">
            <div class="form-group">
                <label>Password Baru</label>
                <div style="position: relative; display: flex; align-items: center;">
                    <input type="password" name="password" id="reset_pass" class="form-control" placeholder="Minimal 6 karakter" required minlength="6">
                    <span class="password-toggle" onclick="togglePassword('reset_pass')" style="position: absolute; right: 15px; cursor: pointer;">
                        <i id="toggle-reset_pass" class="fa-solid fa-eye"></i>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label>Konfirmasi Password</label>
                <div style="position: relative; display: flex; align-items: center;">
                    <input type="password" id="confirm_pass" class="form-control" placeholder="Ulangi password baru" required>
                    <span class="password-toggle" onclick="togglePassword('confirm_pass')" style="position: absolute; right: 15px; cursor: pointer;">
                        <i id="toggle-confirm_pass" class="fa-solid fa-eye"></i>
                    </span>
                </div>
            </div>
            <button type="submit" class="btn-submit">SIMPAN PASSWORD BARU</button>
        </form>
    </div>
</body>
</html>
