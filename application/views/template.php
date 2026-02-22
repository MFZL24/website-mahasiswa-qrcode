<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Attendance System</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #eef2ff;
            --secondary: #10b981;
            --accent: #f43f5e;
            --bg: #f9fafb;
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --white: #ffffff;
            --sidebar-width: 280px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--sidebar-bg);
            color: var(--white);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            transition: all 0.3s;
            z-index: 1000;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar-brand {
            padding: 30px 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .brand-logo {
            width: 40px;
            height: 40px;
            background: var(--primary);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .brand-name {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .sidebar-menu {
            flex: 1;
            padding: 20px 15px;
            list-style: none;
            overflow-y: auto;
        }

        .menu-label {
            padding: 10px 15px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: rgba(255,255,255,0.4);
            letter-spacing: 1px;
        }

        .menu-item {
            margin-bottom: 5px;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            border-radius: 10px;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.2s;
        }

        .menu-link i {
            width: 20px;
            text-align: center;
            font-size: 18px;
        }

        .menu-link:hover, .menu-link.active {
            color: var(--white);
            background-color: var(--sidebar-hover);
        }

        .menu-link.active {
            background-color: var(--primary);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255,255,255,0.05);
        }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 12px;
            color: #fda4af;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            border-radius: 10px;
            transition: background 0.2s;
        }

        .btn-logout:hover {
            background: rgba(244, 63, 94, 0.1);
        }

        /* Main Content Styling */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .top-navbar {
            height: 70px;
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            position: sticky;
            top: 0;
            z-index: 900;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .nav-left h4 {
            font-weight: 600;
            color: var(--text-main);
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 5px 15px;
            background: var(--bg);
            border-radius: 50px;
            cursor: pointer;
        }

        .user-info {
            text-align: right;
        }

        .user-name {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-main);
        }

        .user-role {
            display: block;
            font-size: 11px;
            color: var(--text-muted);
            text-transform: capitalize;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
        }

        .content-body {
            padding: 40px;
            flex: 1;
        }

        /* Common UI Components */
        .card {
            background: var(--white);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-main);
        }

        /* Buttons Custom */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 8px;
        }

        .btn-danger { background: #fee2e2; color: #ef4444; }
        .btn-danger:hover { background: #ef4444; color: white; }

        .btn-edit { background: #fef9c3; color: #a16207; }
        .btn-edit:hover { background: #a16207; color: white; }

        /* Tables Premium */
        .table-container {
            margin-top: 20px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #f1f5f9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f8fafc;
            padding: 15px 20px;
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--text-muted);
            letter-spacing: 0.5px;
        }

        td {
            padding: 16px 20px;
            font-size: 14px;
            border-top: 1px solid #f1f5f9;
            color: var(--text-main);
        }

        tr:hover td {
            background: #fcfdfe;
        }

        /* Badges */
        .badge {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .badge-primary { background: var(--primary-light); color: var(--primary); }
        .badge-success { background: #dcfce7; color: #16a34a; }

        /* Alert */
        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 14px;
            font-weight: 500;
        }

        .alert-success { background: #dcfce7; color: #16a34a; border: 1px solid #bbf7d0; }
        /* Neo-Modern Form Design System */
        .form-container-card {
            max-width: 900px;
            margin: 30px auto;
            background: white;
            padding: 50px;
            border-radius: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.03);
            border: 1px solid #f1f5f9;
            position: relative;
        }
        .form-section-title {
            font-size: 22px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 35px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .form-section-title i {
            width: 45px;
            height: 45px;
            background: #eef2ff;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            font-size: 20px;
        }
        .input-wrapper {
            position: relative;
            margin-bottom: 25px;
        }
        .input-wrapper label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #475569;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .input-field-container {
            position: relative;
            display: flex;
            align-items: center;
        }
        .input-field-container i {
            position: absolute;
            left: 20px;
            color: #94a3b8;
            font-size: 16px;
            transition: all 0.3s;
        }
        .form-control {
            width: 100%;
            padding: 15px 15px 15px 55px; /* Spasi untuk icon */
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            font-size: 15px;
            color: #1e293b;
            background: #fff;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            outline: none;
        }
        .form-control:focus {
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 5px rgba(79, 70, 229, 0.1);
        }
        .form-control:focus + i {
            color: var(--primary);
            transform: scale(1.1);
        }
        .select-pure {
            appearance: none;
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 20px center;
            background-size: 20px;
        }

        /* Password Toggle Styling */
        .password-toggle {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #94a3b8;
            transition: all 0.3s;
            z-index: 10;
        }
        .password-toggle:hover {
            color: var(--primary);
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-logo">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <span class="brand-name">SMART ABSEN</span>
        </div>

        <div style="padding: 20px 25px; border-bottom: 1px solid rgba(255,255,255,0.05); text-align: center;">
            <div style="position: relative; display: inline-block; margin-bottom: 12px;">
                <img src="<?= base_url('assets/img/profile/').($this->session->userdata('foto')?$this->session->userdata('foto'):'default.png') ?>" style="width: 70px; height: 70px; border-radius: 20px; object-fit: cover; border: 2px solid rgba(255,255,255,0.1);">
                <div style="position: absolute; bottom: -3px; right: -3px; width: 14px; height: 14px; background: #10b981; border: 2px solid var(--sidebar-bg); border-radius: 50%;"></div>
            </div>
            <div style="font-weight: 700; font-size: 14px; color: white; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                <?= $this->session->userdata('nama') ?>
            </div>
            <div style="font-size: 11px; color: rgba(255,255,255,0.4); text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-top: 4px;">
                <?= $this->session->userdata('role') ?>
            </div>
        </div>
        
        <ul class="sidebar-menu">
            <li class="menu-label">Menu Utama</li>
            <li class="menu-item">
                <a href="<?= base_url('index.php/dashboard') ?>" class="menu-link" id="menu-dashboard">
                    <i class="fa-solid fa-house"></i> Dashboard
                </a>
            </li>

            <?php if($this->session->userdata('role') == 'admin'): ?>
                <li class="menu-label">Manajemen Data</li>
                <li class="menu-item"><a href="<?= base_url('index.php/operator') ?>" class="menu-link" id="menu-operator"><i class="fa-solid fa-user-shield"></i> User Operator</a></li>
                <li class="menu-item"><a href="<?= base_url('index.php/mahasiswa') ?>" class="menu-link" id="menu-mahasiswa"><i class="fa-solid fa-user-graduate"></i> Mahasiswa</a></li>
                <li class="menu-item"><a href="<?= base_url('index.php/dosen') ?>" class="menu-link" id="menu-dosen"><i class="fa-solid fa-user-tie"></i> Dosen</a></li>
                <li class="menu-item"><a href="<?= base_url('index.php/matakuliah') ?>" class="menu-link" id="menu-matakuliah"><i class="fa-solid fa-book-open"></i> Mata Kuliah</a></li>
                
                <li class="menu-label">Akademik</li>
                <li class="menu-item"><a href="<?= base_url('index.php/kelas') ?>" class="menu-link" id="menu-kelas"><i class="fa-solid fa-chalkboard-user"></i> Data Kelas & Jadwal</a></li>
                <li class="menu-item"><a href="<?= base_url('index.php/krs') ?>" class="menu-link" id="menu-krs"><i class="fa-solid fa-id-card"></i> Monitoring KRS</a></li>
                <li class="menu-item"><a href="<?= base_url('index.php/pertemuan') ?>" class="menu-link" id="menu-pertemuan"><i class="fa-solid fa-calendar-check"></i> Sesi Perkuliahan</a></li>
                <li class="menu-item"><a href="<?= base_url('index.php/absensi/laporan') ?>" class="menu-link" id="menu-laporan"><i class="fa-solid fa-file-invoice"></i> Laporan Kehadiran</a></li>
            <?php endif; ?>

            <?php if($this->session->userdata('role') == 'dosen'): ?>
                <li class="menu-label">Menu Dosen</li>
                <li class="menu-item"><a href="<?= base_url('index.php/dosen_fitur/jadwal') ?>" class="menu-link" id="menu-dosen-jadwal"><i class="fa-solid fa-calendar-alt"></i> Jadwal Mengajar</a></li>
                <li class="menu-item"><a href="<?= base_url('index.php/dosen_fitur/absensi') ?>" class="menu-link" id="menu-dosen-absensi"><i class="fa-solid fa-qrcode"></i> Buka Absensi</a></li>
            <?php endif; ?>

            <?php if($this->session->userdata('role') == 'mahasiswa'): ?>
                <li class="menu-label">Menu Mahasiswa</li>
                <li class="menu-item"><a href="<?= base_url('index.php/mhs_fitur/scan') ?>" class="menu-link" id="menu-scan"><i class="fa-solid fa-camera"></i> Scan Kehadiran</a></li>
                <li class="menu-item"><a href="<?= base_url('index.php/mhs_fitur/jadwal') ?>" class="menu-link" id="menu-mhs-jadwal"><i class="fa-solid fa-calendar-days"></i> Jadwal Kuliah Saya</a></li>
                <li class="menu-item"><a href="<?= base_url('index.php/mhs_fitur/krs') ?>" class="menu-link" id="menu-mhs-krs"><i class="fa-solid fa-book-bookmark"></i> Mata Kuliah (KRS)</a></li>
            <?php endif; ?>

            <li class="menu-label">Akun</li>
            <li class="menu-item"><a href="<?= base_url('index.php/profile') ?>" class="menu-link" id="menu-profile"><i class="fa-solid fa-user-gear"></i> Pengaturan Profil</a></li>
        </ul>

        <div class="sidebar-footer">
            <a href="<?= base_url('index.php/auth/logout') ?>" class="btn-logout">
                <i class="fa-solid fa-power-off"></i>
                <span>Logout System</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-wrapper">
        <nav class="top-navbar">
            <div class="nav-left">
                <h4>Sistem Informasi Absensi</h4>
            </div>
            <div class="nav-right">
                <div class="user-profile">
                    <div class="user-info">
                        <span class="user-name"><?= $this->session->userdata('username') ?></span>
                        <span class="user-role"><?= $this->session->userdata('role') ?></span>
                    </div>
                    <div class="user-avatar"><?= strtoupper(substr($this->session->userdata('username'), 0, 1)) ?></div>
                </div>
            </div>
        </nav>

        <div class="content-body">
            <div class="card">
                <?php echo $contents; ?>
            </div>
        </div>
    </div>

    <script>
        // Active Menu Logic Improved
        const currentPath = window.location.href;
        const menuLinks = document.querySelectorAll('.menu-link');
        
        menuLinks.forEach(link => {
            if(currentPath.includes(link.getAttribute('href'))) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    </script>
    <script>
        function togglePassword(id) {
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

        // Auto-close alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>
