<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universitas Global Mandiri | Membangun Masa Depan</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #006874;
            --primary-dark: #004f58;
            --secondary: #f6b553;
            --light: #f0f7f8;
            --white: #ffffff;
        }
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Outfit',sans-serif; }
        html { scroll-behavior: smooth; }
        body { color: #1e293b; overflow-x: hidden; }

        /* ====== NAVBAR ====== */
        nav {
            position: fixed; top: 0; left: 0; width: 100%;
            padding: 0 6%; height: 70px;
            display: flex; justify-content: space-between; align-items: center;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(12px);
            z-index: 1000;
            border-bottom: 1px solid rgba(0,104,116,0.1);
            box-shadow: 0 2px 20px rgba(0,0,0,0.05);
        }
        .logo { display:flex; align-items:center; gap:10px; font-size:22px; font-weight:800; color:var(--primary); text-decoration:none; }
        .logo i { font-size: 28px; }
        .nav-links { display:flex; gap:30px; list-style:none; align-items: center; }
        .nav-links a { text-decoration:none; color:#334155; font-weight:600; font-size:15px; transition:color 0.3s; }
        .nav-links a:hover { color: var(--primary); }
        .login-btn {
            background: var(--primary) !important; color: white !important;
            padding: 10px 24px; border-radius: 50px; font-size: 14px !important;
            box-shadow: 0 4px 12px rgba(0,104,116,0.25);
            transition: all 0.3s !important;
        }
        .login-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,104,116,0.35) !important; }

        /* Hamburger */
        .hamburger { display: none; font-size: 26px; color: var(--primary); cursor: pointer; z-index: 1100; }
        .mobile-menu {
            display: none; position: fixed; top: 70px; left: 0; width: 100%;
            background: white; padding: 20px; flex-direction: column; gap: 5px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); z-index: 999;
            border-bottom: 3px solid var(--primary);
        }
        .mobile-menu.open { display: flex; }
        .mobile-menu a { padding: 14px 20px; text-decoration: none; color: #334155; font-weight: 600; border-radius: 12px; transition: all 0.2s; }
        .mobile-menu a:hover { background: var(--light); color: var(--primary); }
        .mobile-menu .login-btn { background: var(--primary) !important; color: white !important; text-align: center; margin-top: 10px; }

        /* ====== HERO ====== */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, rgba(0,79,88,0.85) 0%, rgba(0,104,116,0.7) 100%),
                url('https://images.unsplash.com/photo-1541339907198-e08756ebafe3?auto=format&fit=crop&q=80&w=2000') center/cover no-repeat;
            display: flex; align-items: center; padding: 100px 6% 60px;
            color: white;
        }
        .hero-content { max-width: 700px; }
        .hero-tag {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(255,255,255,0.15); backdrop-filter: blur(10px);
            padding: 8px 20px; border-radius: 50px; font-size: 13px; font-weight: 700;
            margin-bottom: 25px; border: 1px solid rgba(255,255,255,0.2);
            letter-spacing: 1px; text-transform: uppercase;
        }
        .hero h1 { font-size: clamp(36px, 6vw, 72px); font-weight: 900; line-height: 1.1; margin-bottom: 20px; }
        .hero h1 span { color: var(--secondary); }
        .hero p { font-size: clamp(15px, 2vw, 18px); opacity: 0.9; line-height: 1.7; margin-bottom: 40px; }
        .cta-group { display: flex; gap: 15px; flex-wrap: wrap; }
        .cta-btn {
            padding: 14px 32px; border-radius: 50px; font-size: 16px; font-weight: 700;
            text-decoration: none; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-gold { background: var(--secondary); color: #002023; box-shadow: 0 8px 20px rgba(246,181,83,0.4); }
        .btn-gold:hover { transform: translateY(-3px); box-shadow: 0 15px 30px rgba(246,181,83,0.5); }
        .btn-glass { background: rgba(255,255,255,0.15); color: white; border: 2px solid rgba(255,255,255,0.4); backdrop-filter: blur(6px); }
        .btn-glass:hover { background: rgba(255,255,255,0.25); }

        /* Hero Stats */
        .hero-stats {
            display: grid; grid-template-columns: repeat(3, auto); gap: 30px; margin-top: 60px;
            border-top: 1px solid rgba(255,255,255,0.15); padding-top: 40px;
        }
        .stat { text-align: left; }
        .stat-number { font-size: clamp(28px, 4vw, 40px); font-weight: 900; color: var(--secondary); }
        .stat-label { font-size: 13px; opacity: 0.7; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }

        /* ====== FEATURES ====== */
        .section { padding: 80px 6%; }
        .section-tag { font-size: 12px; font-weight: 800; color: var(--primary); text-transform: uppercase; letter-spacing: 2px; margin-bottom: 15px; }
        .section-title { font-size: clamp(28px, 4vw, 42px); font-weight: 800; color: #0f172a; margin-bottom: 12px; }
        .section-sub { font-size: 16px; color: #64748b; max-width: 550px; line-height: 1.7; }
        .section-header { margin-bottom: 60px; }

        .features { background: var(--light); }
        .features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; }
        .feature-card {
            background: white; padding: 40px 30px; border-radius: 24px;
            transition: all 0.3s; border: 1px solid rgba(0,104,116,0.05);
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        }
        .feature-card:hover { transform: translateY(-10px); box-shadow: 0 20px 50px rgba(0,104,116,0.12); }
        .feature-icon {
            width: 65px; height: 65px; background: var(--light); color: var(--primary);
            border-radius: 18px; display: flex; align-items: center; justify-content: center;
            font-size: 28px; margin-bottom: 25px;
        }
        .feature-card h3 { font-size: 20px; font-weight: 800; margin-bottom: 12px; }
        .feature-card p { font-size: 14px; color: #64748b; line-height: 1.7; }

        /* ====== PRODI ====== */
        .prodi-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
        .prodi-card {
            padding: 30px 20px; border-radius: 20px; text-align: center;
            border: 2px solid rgba(0,104,116,0.1);
            transition: all 0.3s; cursor: pointer;
        }
        .prodi-card:hover { background: var(--primary); color: white; border-color: var(--primary); transform: translateY(-5px); }
        .prodi-card:hover i, .prodi-card:hover h4, .prodi-card:hover span { color: white !important; }
        .prodi-card i { font-size: 36px; color: var(--primary); margin-bottom: 15px; display: block; transition: color 0.3s; }
        .prodi-card h4 { font-size: 15px; font-weight: 800; margin-bottom: 5px; transition: color 0.3s; }
        .prodi-card span { font-size: 12px; color: #64748b; font-weight: 600; transition: color 0.3s; }

        /* ====== CTA SECTION ====== */
        .cta-section {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            color: white; text-align: center; padding: 90px 6%;
        }
        .cta-section h2 { font-size: clamp(28px, 4vw, 48px); font-weight: 900; margin-bottom: 20px; }
        .cta-section p { font-size: 17px; opacity: 0.85; max-width: 600px; margin: 0 auto 40px; line-height: 1.7; }

        /* ====== FOOTER ====== */
        footer {
            background: #00252a; color: white;
            padding: 70px 6% 30px;
        }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 50px; margin-bottom: 50px; }
        .footer-brand .logo { font-size: 26px; margin-bottom: 20px; }
        .footer-brand p { font-size: 14px; opacity: 0.6; line-height: 1.8; margin-bottom: 25px; }
        .social-links { display: flex; gap: 12px; }
        .social-links a {
            width: 42px; height: 42px; background: rgba(255,255,255,0.08); border-radius: 12px;
            display: flex; align-items: center; justify-content: center; color: white; font-size: 16px;
            transition: all 0.3s; text-decoration: none;
        }
        .social-links a:hover { background: var(--secondary); color: #002023; transform: translateY(-3px); }
        .footer-col h5 { font-size: 14px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px; color: rgba(255,255,255,0.5); }
        .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 10px; }
        .footer-col ul li a { text-decoration: none; color: rgba(255,255,255,0.6); font-size: 14px; transition: color 0.2s; }
        .footer-col ul li a:hover { color: var(--secondary); }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,0.08); padding-top: 30px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; }
        .footer-bottom p { font-size: 13px; opacity: 0.4; }

        /* ====== MOBILE RESPONSIVE ====== */
        @media (max-width: 1024px) {
            .features-grid { grid-template-columns: repeat(2, 1fr); }
            .prodi-grid { grid-template-columns: repeat(2, 1fr); }
            .footer-grid { grid-template-columns: 1fr 1fr; }
            .footer-brand { grid-column: 1/-1; }
        }
        @media (max-width: 768px) {
            .nav-links { display: none; }
            .hamburger { display: block; }
            .hero { padding: 90px 6% 50px; text-align: center; }
            .hero-content { max-width: 100%; }
            .cta-group { justify-content: center; }
            .hero-stats { grid-template-columns: repeat(3, 1fr); border-top: 1px solid rgba(255,255,255,0.15); }
            .features-grid { grid-template-columns: 1fr; }
            .prodi-grid { grid-template-columns: repeat(2, 1fr); }
            .section-header { text-align: center; }
            .section-header .section-sub { margin: 0 auto; }
            .footer-grid { grid-template-columns: 1fr; gap: 30px; }
            .footer-bottom { flex-direction: column; text-align: center; }
        }
        @media (max-width: 480px) {
            .hero-stats { grid-template-columns: 1fr; gap: 15px; }
            .cta-btn { width: 100%; justify-content: center; }
            .prodi-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav>
    <a href="<?= base_url() ?>" class="logo">
        <i class="fa-solid fa-university"></i> UNIGLOBAL
    </a>
    <ul class="nav-links">
        <li><a href="#beranda">Beranda</a></li>
        <li><a href="#keunggulan">Keunggulan</a></li>
        <li><a href="#prodi">Program Studi</a></li>
        <li><a href="#">Kontak</a></li>
        <li><a href="<?= base_url('index.php/auth/login') ?>" class="login-btn">
            <i class="fa-solid fa-right-to-bracket"></i> SISFO Login
        </a></li>
    </ul>
    <div class="hamburger" id="hamburger" onclick="toggleMenu()">
        <i class="fa-solid fa-bars" id="menuIcon"></i>
    </div>
</nav>

<!-- MOBILE MENU -->
<div class="mobile-menu" id="mobileMenu">
    <a href="#beranda" onclick="toggleMenu()">Beranda</a>
    <a href="#keunggulan" onclick="toggleMenu()">Keunggulan</a>
    <a href="#prodi" onclick="toggleMenu()">Program Studi</a>
    <a href="#" onclick="toggleMenu()">Kontak</a>
    <a href="<?= base_url('index.php/auth/login') ?>" class="login-btn">SISFO Login</a>
</div>

<!-- HERO -->
<section class="hero" id="beranda">
    <div class="hero-content">
        <div class="hero-tag">
            <i class="fa-solid fa-award"></i> Akreditasi Unggul BAN-PT
        </div>
        <h1>Membangun Generasi <span>Unggul</span> & Berkarakter.</h1>
        <p>Bergabunglah bersama ribuan mahasiswa kami. Raih prestasi akademik setinggi-tingginya dengan dukungan teknologi kampus terdepan.</p>
        <div class="cta-group">
            <a href="#" class="cta-btn btn-gold"><i class="fa-solid fa-file-pen"></i> Daftar Sekarang</a>
            <a href="#keunggulan" class="cta-btn btn-glass"><i class="fa-solid fa-play"></i> Pelajari Lebih</a>
        </div>
        <div class="hero-stats">
            <div class="stat">
                <div class="stat-number">15k+</div>
                <div class="stat-label">Mahasiswa Aktif</div>
            </div>
            <div class="stat">
                <div class="stat-number">48</div>
                <div class="stat-label">Program Studi</div>
            </div>
            <div class="stat">
                <div class="stat-number">98%</div>
                <div class="stat-label">Tingkat Kerja</div>
            </div>
        </div>
    </div>
</section>

<!-- KEUNGGULAN -->
<section class="section features" id="keunggulan">
    <div class="section-header">
        <div class="section-tag">Mengapa Kami?</div>
        <h2 class="section-title">Standar Kualitas Internasional</h2>
        <p class="section-sub">Fasilitas terbaik, kurikulum global, dan teknologi terdepan untuk masa depan Anda.</p>
    </div>
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon"><i class="fa-solid fa-qrcode"></i></div>
            <h3>Absensi QR Code</h3>
            <p>Sistem kehadiran digital berbasis QR Code secara real-time. Akurat, cepat, dan tanpa kertas.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon"><i class="fa-solid fa-globe"></i></div>
            <h3>Kelas Internasional</h3>
            <p>Program kelas bertaraf internasional berkolaborasi dengan universitas-universitas top dunia.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon"><i class="fa-solid fa-briefcase"></i></div>
            <h3>Career Center</h3>
            <p>Jaringan alumni luas dan kerjasama 500+ perusahaan untuk mempermudah karier Anda.</p>
        </div>
    </div>
</section>

<!-- PROGRAM STUDI -->
<section class="section" id="prodi">
    <div class="section-header">
        <div class="section-tag">Akademik</div>
        <h2 class="section-title">Program Studi Unggulan</h2>
        <p class="section-sub">Pilih dari puluhan program studi terakreditasi yang sesuai minat dan bakat Anda.</p>
    </div>
    <div class="prodi-grid">
        <div class="prodi-card">
            <i class="fa-solid fa-laptop-code"></i>
            <h4>Teknik Informatika</h4>
            <span>S1 • Akreditasi Unggul</span>
        </div>
        <div class="prodi-card">
            <i class="fa-solid fa-microchip"></i>
            <h4>Teknik Elektro</h4>
            <span>S1 • Akreditasi A</span>
        </div>
        <div class="prodi-card">
            <i class="fa-solid fa-chart-line"></i>
            <h4>Manajemen Bisnis</h4>
            <span>S1 • Akreditasi Unggul</span>
        </div>
        <div class="prodi-card">
            <i class="fa-solid fa-flask"></i>
            <h4>Farmasi</h4>
            <span>S1 • Akreditasi A</span>
        </div>
        <div class="prodi-card">
            <i class="fa-solid fa-scale-balanced"></i>
            <h4>Hukum</h4>
            <span>S1 • Akreditasi Unggul</span>
        </div>
        <div class="prodi-card">
            <i class="fa-solid fa-building"></i>
            <h4>Arsitektur</h4>
            <span>S1 • Akreditasi A</span>
        </div>
        <div class="prodi-card">
            <i class="fa-solid fa-heart-pulse"></i>
            <h4>Kedokteran</h4>
            <span>S1 • Akreditasi Unggul</span>
        </div>
        <div class="prodi-card">
            <i class="fa-solid fa-seedling"></i>
            <h4>Agribisnis</h4>
            <span>S1 • Akreditasi A</span>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section class="cta-section">
    <h2>Siap Memulai Perjalanan Anda?</h2>
    <p>Daftar sekarang dan jadilah bagian dari komunitas akademik terbaik di Indonesia.</p>
    <div class="cta-group" style="justify-content:center;">
        <a href="#" class="cta-btn btn-gold"><i class="fa-solid fa-file-pen"></i> Pendaftaran Online</a>
        <a href="<?= base_url('index.php/auth/login') ?>" class="cta-btn btn-glass"><i class="fa-solid fa-right-to-bracket"></i> Login SISFO</a>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="footer-grid">
        <div class="footer-brand">
            <a href="<?= base_url() ?>" class="logo" style="color:white; display:inline-flex; margin-bottom:15px;">
                <i class="fa-solid fa-university"></i> UNIGLOBAL
            </a>
            <p>Universitas Global Mandiri berkomitmen menghadirkan pendidikan tinggi berkualitas dan relevan dengan kebutuhan industri global.</p>
            <div class="social-links">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
        <div class="footer-col">
            <h5>Akademik</h5>
            <ul>
                <li><a href="#">Program Sarjana</a></li>
                <li><a href="#">Program Pascasarjana</a></li>
                <li><a href="#">Kalender Akademik</a></li>
                <li><a href="#">Perpustakaan</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h5>Kampus</h5>
            <ul>
                <li><a href="#">Tentang Kami</a></li>
                <li><a href="#">Fasilitas</a></li>
                <li><a href="#">Berita & Acara</a></li>
                <li><a href="#">Kontak</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2026 Universitas Global Mandiri. All Rights Reserved.</p>
        <p>Dibuat dengan <i class="fa-solid fa-heart" style="color:#f43f5e;"></i> untuk pendidikan Indonesia.</p>
    </div>
</footer>

<script>
    function toggleMenu() {
        const menu = document.getElementById('mobileMenu');
        const icon = document.getElementById('menuIcon');
        menu.classList.toggle('open');
        if (menu.classList.contains('open')) {
            icon.className = 'fa-solid fa-xmark';
        } else {
            icon.className = 'fa-solid fa-bars';
        }
    }
</script>

</body>
</html>
