<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <title>UNIKI Attendance | Portal Akademik Terpadu</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/kampus/logo.png') ?>">
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #006874;
            --primary-dark: #004f58;
            --primary-light: #f0f7f8;
            --secondary: #10b981;
            --accent: #f43f5e;
            --bg: #f8fafc;
            --sidebar-bg: #012a2e;
            --sidebar-width: 280px;
            --topbar-height: 80px;
            --white: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-tap-highlight-color: transparent;
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: var(--transition);
        }

        body {
            background: var(--bg);
            color: var(--text-main);
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            box-shadow: 10px 0 30px rgba(0,0,0,0.05);
        }

        .sidebar-brand {
            padding: 35px 25px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .logo-box {
            background: white;
            padding: 12px;
            border-radius: 20px;
            width: 85px;
            height: 85px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 12px 25px rgba(0,0,0,0.3);
            border: 3px solid rgba(255,255,255,0.1);
        }

        .brand-text {
            text-align: center;
        }

        .brand-name {
            color: white;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 1px;
            display: block;
        }

        .brand-sub {
            color: rgba(255,255,255,0.5);
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 4px;
            line-height: 1.4;
        }

        .sidebar-menu {
            flex: 1;
            padding: 25px 15px;
            list-style: none;
            overflow-y: auto;
        }

        .menu-label {
            padding: 15px 15px 10px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            color: rgba(255,255,255,0.3);
            letter-spacing: 2px;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            border-radius: 14px;
            font-weight: 600;
            font-size: 14px;
            transition: var(--transition);
            margin-bottom: 5px;
        }

        .menu-link i {
            font-size: 18px;
            width: 25px;
            text-align: center;
            opacity: 0.8;
        }

        .menu-link:hover {
            color: white;
            background: rgba(255,255,255,0.05);
            transform: translateX(5px);
        }

        .menu-link.active {
            color: white;
            background: var(--primary);
            box-shadow: 0 10px 20px rgba(0, 104, 116, 0.3);
        }

        .sidebar-footer {
            padding: 25px;
            border-top: 1px solid rgba(255,255,255,0.05);
        }

        .btn-logout {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px;
            background: rgba(244, 63, 94, 0.1);
            color: #fb7185;
            text-decoration: none;
            font-size: 13px;
            font-weight: 800;
            border-radius: 14px;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-logout:hover {
            background: #e11d48;
            color: white;
            box-shadow: 0 8px 20px rgba(225, 29, 72, 0.2);
        }

        /* Main Wrapper */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: var(--transition);
        }

        /* Top Navbar */
        .top-navbar {
            height: var(--topbar-height);
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(12px);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            position: sticky;
            top: 0;
            z-index: 900;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .hamburger {
            display: none;
            cursor: pointer;
            font-size: 24px;
            color: var(--primary);
        }

        .nav-title h4 {
            font-size: 18px;
            font-weight: 800;
            color: #1e293b;
        }

        .nav-title p {
            font-size: 11px;
            color: #64748b;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
            background: white;
            padding: 8px 15px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            cursor: pointer;
            transition: all 0.3s;
        }

        .user-profile:hover {
            border-color: var(--primary);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .user-info {
            text-align: right;
        }

        .user-name {
            display: block;
            font-size: 14px;
            font-weight: 800;
            color: #1e293b;
        }

        .user-role {
            display: block;
            font-size: 10px;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 18px;
            box-shadow: 0 8px 15px rgba(0, 104, 116, 0.2);
            object-fit: cover;
        }

        /* Content Body */
        .content-body {
            padding: 45px 50px;
            flex: 1;
            max-width: 1600px;
            width: 100%;
            margin: 0 auto;
        }

        /* Sidebar Overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            backdrop-filter: blur(4px);
            z-index: 999;
        }

        /* UI Global Utilities - NEO MODERN */
        .card {
            background: white;
            border-radius: 30px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            border: 1px solid #f1f5f9;
            margin-bottom: 30px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            gap: 15px;
            flex-wrap: wrap;
        }

        .card-title {
            font-size: 20px;
            font-weight: 800;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 24px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            white-space: nowrap;
        }

        .btn-primary { background: var(--primary); color: white; box-shadow: 0 10px 20px rgba(0, 104, 116, 0.2); }
        .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 15px 30px rgba(0, 104, 116, 0.3); opacity: 0.95; }
        .btn-sm { padding: 8px 16px; font-size: 12px; border-radius: 10px; }
        .btn-danger { background: #fff1f2; color: #e11d48; border: 1px solid #ffe4e6; }
        .btn-danger:hover { background: #e11d48; color: white; }
        .btn-edit { background: #eff6ff; color: #2563eb; border: 1px solid #dbeafe; }
        .btn-edit:hover { background: #2563eb; color: white; }

        .table-container { margin-top: 20px; border-radius: 20px; overflow: hidden; border: 1px solid #f1f5f9; background: white; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f8fafc; padding: 18px 25px; text-align: left; font-size: 12px; font-weight: 800; text-transform: uppercase; color: #64748b; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9; }
        td { padding: 20px 25px; font-size: 14px; border-top: 1px solid #f1f5f9; color: #1e293b; font-weight: 500; }
        tr:hover td { background: #fcfdfe; }

        .badge { padding: 6px 14px; border-radius: 10px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; display: inline-flex; align-items: center; gap: 6px; }
        .badge-primary { background: var(--primary-light); color: var(--primary); }
        .badge-success { background: #dcfce7; color: #15803d; }
        .badge-danger { background: #fff1f2; color: #e11d48; }
        .badge-warning { background: #fffbeb; color: #d97706; }

        .alert { padding: 18px 25px; border-radius: 18px; margin-bottom: 30px; font-size: 14px; font-weight: 700; display: flex; align-items: center; gap: 12px; border: 1px solid transparent; }
        .alert-success { background: #ecfdf5; color: #059669; border-color: #d1fae5; }
        .alert-danger { background: #fff1f2; color: #e11d48; border-color: #ffe4e6; }

        .input-wrapper { margin-bottom: 25px; }
        .input-wrapper label { display: block; font-size: 12px; font-weight: 800; color: #64748b; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1px; }
        .form-control { width: 100%; padding: 14px 20px 14px 20px; border: 2px solid #f1f5f9; border-radius: 16px; font-size: 15px; font-weight: 600; background: #f8fafc; color: #1e293b; transition: all 0.3s; outline: none; }
        .form-control:focus { border-color: var(--primary); background: white; box-shadow: 0 0 0 4px rgba(0, 104, 116, 0.05); }

        .form-container-card { max-width: 900px; margin: 0 auto; background: white; padding: 50px; border-radius: 35px; box-shadow: 0 10px 40px rgba(0,0,0,0.03); border: 1px solid #f1f5f9; }
        .form-section-title { font-size: 20px; font-weight: 900; color: #1e293b; margin-bottom: 35px; display: flex; align-items: center; gap: 15px; }

        /* Mobile Responsive Overhaul */
        @media (max-width: 1024px) {
            .sidebar { left: calc(-1 * var(--sidebar-width)); }
            .sidebar.active { left: 0; }
            .main-wrapper { margin-left: 0; }
            .hamburger { display: block; }
            .top-navbar { padding: 0 20px; }
            .nav-title h4 { display: none; }
            .user-info { display: none; }
            .content-body { padding: 25px 20px; }
            .sidebar-overlay.active { display: block; }
            
            .card { padding: 25px; border-radius: 20px; }
            .card-header { margin-bottom: 20px; }
            .card-title { font-size: 18px; }
        }

        @media (max-width: 768px) {
            :root {
                --topbar-height: 70px;
            }
            .content-body { padding: 20px 15px; }
            .top-navbar { padding: 0 15px; }
            .nav-title p { font-size: 9px; }
            
            .table-container { border-radius: 15px; }
            th, td { padding: 15px; font-size: 13px; }
            
            .form-container-card { padding: 30px 20px; border-radius: 25px; }
            .form-section-title { font-size: 17px; margin-bottom: 25px; }
            
            .btn { padding: 10px 20px; font-size: 13px; border-radius: 12px; }
            
            /* Fluid Grid for cards on mobile */
            .responsive-grid {
                grid-template-columns: 1fr !important;
                gap: 15px !important;
            }
        }

        @media (max-width: 480px) {
            .card { padding: 20px 15px; }
            .btn { width: 100%; justify-content: center; }
            .user-avatar { width: 35px; height: 35px; }
            .logo-box { width: 70px; height: 70px; }
            .brand-name { font-size: 18px; }
        }

        /* Utility classes for views to use */
        .m-stack { display: flex; flex-direction: column; }
        @media (min-width: 769px) {
            .m-stack { flex-direction: row; }
        }
        
        .hide-mobile { display: none !important; }
        @media (min-width: 769px) {
            .hide-mobile { display: block !important; }
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="logo-box">
                <img src="<?= base_url('assets/kampus/logo.png') ?>" style="width: 100%; height: 100%; object-fit: contain;">
            </div>
            <div class="brand-text">
                <span class="brand-name">UNIKI ABSENSI</span>
                <span class="brand-sub">Universitas Kebangsaan<br>Indonesia</span>
            </div>
        </div>

        <nav class="sidebar-menu">
            <li class="menu-label">Main Navigation</li>
            <li>
                <a href="<?= base_url('index.php/dashboard') ?>" class="menu-link" id="menu-dashboard">
                    <i class="fa-solid fa-house-chimney"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <?php if($this->session->userdata('role') == 'admin'): ?>
                <li class="menu-label">Master Data</li>
                <li><a href="<?= base_url('index.php/operator') ?>" class="menu-link" id="menu-operator"><i class="fa-solid fa-user-shield"></i> <span>Akses Operator</span></a></li>
                <li><a href="<?= base_url('index.php/mahasiswa') ?>" class="menu-link" id="menu-mahasiswa"><i class="fa-solid fa-user-graduate"></i> <span>Data Mahasiswa</span></a></li>
                <li><a href="<?= base_url('index.php/dosen') ?>" class="menu-link" id="menu-dosen"><i class="fa-solid fa-user-tie"></i> <span>Direktori Dosen</span></a></li>
                <li><a href="<?= base_url('index.php/matakuliah') ?>" class="menu-link" id="menu-matakuliah"><i class="fa-solid fa-book-open-reader"></i> <span>Mata Kuliah</span></a></li>
                
                <li class="menu-label">Academic</li>
                <li><a href="<?= base_url('index.php/kelas') ?>" class="menu-link" id="menu-kelas"><i class="fa-solid fa-calendar-days"></i> <span>Kelas & Jadwal</span></a></li>
                <li><a href="<?= base_url('index.php/krs') ?>" class="menu-link" id="menu-krs"><i class="fa-solid fa-clipboard-list"></i> <span>Monitoring KRS</span></a></li>
                <li><a href="<?= base_url('index.php/absensi/laporan') ?>" class="menu-link" id="menu-laporan"><i class="fa-solid fa-chart-pie"></i> <span>Laporan Absen</span></a></li>
            <?php endif; ?>

            <?php if($this->session->userdata('role') == 'dosen'): ?>
                <li class="menu-label">Dosen Panel</li>
                <li><a href="<?= base_url('index.php/dosen_fitur/jadwal') ?>" class="menu-link" id="menu-dosen-jadwal"><i class="fa-solid fa-calendar-week"></i> <span>Jadwal Mengajar</span></a></li>
                <li><a href="<?= base_url('index.php/dosen_fitur/absensi') ?>" class="menu-link" id="menu-dosen-absensi"><i class="fa-solid fa-qrcode"></i> <span>Buka Presensi</span></a></li>
            <?php endif; ?>

            <?php if($this->session->userdata('role') == 'mahasiswa'): ?>
                <li class="menu-label">Student Portal</li>
                <li><a href="<?= base_url('index.php/mhs_fitur/scan') ?>" class="menu-link" id="menu-scan"><i class="fa-solid fa-qrcode"></i> <span>Scan Kehadiran</span></a></li>
                <li><a href="<?= base_url('index.php/mhs_fitur/jadwal') ?>" class="menu-link" id="menu-mhs-jadwal"><i class="fa-solid fa-calendar-check"></i> <span>Jadwal Saya</span></a></li>
                <li><a href="<?= base_url('index.php/mhs_fitur/krs') ?>" class="menu-link" id="menu-mhs-krs"><i class="fa-solid fa-bookmark"></i> <span>Rencana Studi</span></a></li>
            <?php endif; ?>

            <li class="menu-label">Options</li>
            <li>
                <a href="<?= base_url('index.php/profile') ?>" class="menu-link" id="menu-profile">
                    <i class="fa-solid fa-user-gear"></i>
                    <span>Profil Saya</span>
                </a>
            </li>
        </nav>

        <div class="sidebar-footer">
            <a href="<?= base_url('index.php/auth/logout') ?>" class="btn-logout">
                <i class="fa-solid fa-power-off"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>

    <div class="sidebar-overlay" id="overlay"></div>

    <main class="main-wrapper">
        <header class="top-navbar">
            <div class="nav-left">
                <div class="hamburger" id="hamburger">
                    <i class="fa-solid fa-bars-staggered"></i>
                </div>
                <div class="nav-title">
                    <h4>Portal Akademik Terpadu</h4>
                    <p>Universitas Kebangsaan Indonesia</p>
                </div>
            </div>
            
            <div class="nav-right">
                <div class="user-profile" onclick="window.location.href='<?= base_url('index.php/profile') ?>'">
                    <div class="user-info">
                        <span class="user-name"><?= $this->session->userdata('nama') ?></span>
                        <span class="user-role"><?= $this->session->userdata('role') ?></span>
                    </div>
                    <?php 
                    $foto = $this->session->userdata('foto');
                    $img_src = (strpos($foto, 'http') === 0) ? $foto : base_url('assets/img/profile/').($foto ? $foto : 'default.png');
                    ?>
                    <img src="<?= $img_src ?>" class="user-avatar shadow-sm">
                </div>
            </div>
        </header>

        <section class="content-body">
            <?php echo $contents; ?>
        </section>
    </main>

    <script>
        // Sidebar Toggle
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        hamburger.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);

        // Active Link Highlighting
        const currentPath = window.location.href;
        document.querySelectorAll('.menu-link').forEach(link => {
            if (currentPath.includes(link.getAttribute('href'))) {
                link.classList.add('active');
            }
        });

        // Toggle Password visibility global
        function togglePassword(id) {
            const field = document.getElementById(id);
            const icon = document.getElementById('toggle-' + id);
            if (field.type === "password") {
                field.type = "text";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                field.type = "password";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }

        // Auto-dismiss alerts
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.transition = "opacity 0.6s ease, transform 0.6s ease";
                alert.style.opacity = "0";
                alert.style.transform = "translateY(-10px)";
                setTimeout(() => alert.remove(), 600);
            });
        }, 5000);
    </script>
</body>
</html>
