<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Attendance System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary: #4f46e5; --bg: #f3f4f6; --text-main: #111827; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .card { background: white; width: 100%; max-width: 450px; padding: 40px; border-radius: 24px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); }
        .header { text-align: center; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; }
        .form-control { width: 100%; padding: 12px 15px; border: 2px solid #e5e7eb; border-radius: 12px; font-size: 14px; outline: none; }
        .btn-submit { width: 100%; background: var(--primary); color: white; padding: 14px; border: none; border-radius: 12px; font-size: 16px; font-weight: 600; cursor: pointer; }
        .error-message { background: #fee2e2; color: #dc2626; padding: 12px; border-radius: 10px; font-size: 14px; margin-bottom: 20px; text-align: center; }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <h1>Lupa Password?</h1>
            <p style="color: #666; font-size: 14px; margin-top: 5px;">Verifikasi identitas Anda untuk reset</p>
        </div>

        <?php if($this->session->flashdata('error')): ?>
            <div class="error-message"><?= $this->session->flashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('index.php/auth/proses_forgot_password') ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username Anda" required>
            </div>
            <div class="form-group">
                <label>Identitas Verifikasi (NIM/NIDN)</label>
                <input type="text" name="identity" class="form-control" placeholder="Masukkan NIM atau NIDN" required>
            </div>
            <button type="submit" class="btn-submit">VERIFIKASI DATA</button>
        </form>
        <p style="text-align: center; margin-top: 25px; font-size: 14px;">
            <a href="<?= base_url('index.php/auth/login') ?>" style="color: var(--primary); text-decoration: none; font-weight: 600;">Kembali ke Login</a>
        </p>
    </div>
</body>
</html>
