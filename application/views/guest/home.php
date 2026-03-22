<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNIKI | Universitas Kebangsaan Indonesia</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/kampus/logo.png') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #006874;
            --primary-dark: #004f58;
            --primary-light: #e0f2f1;
            --secondary: #f6b553;
            --accent: #22c55e;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --white: #ffffff;
            --glass: rgba(255, 255, 255, 0.8);
            --glass-border: rgba(255, 255, 255, 0.2);
        }

        * { margin:0; padding:0; box-sizing:border-box; font-family:'Outfit',sans-serif; }
        html { scroll-behavior: smooth; }
        
        body { 
            color: var(--text-main); 
            line-height: 1.6;
            overflow-x: hidden; 
            background: #f8fafc;
        }

        /* ====== NAVBAR ====== */
        nav {
            position: fixed; top: 0; left: 0; width: 100%;
            padding: 0 8%; height: 80px;
            display: flex; justify-content: space-between; align-items: center;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            z-index: 1000;
            border-bottom: 1px solid rgba(0, 104, 116, 0.1);
            transition: all 0.4s ease;
        }
        nav.scrolled {
            height: 70px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .logo { display:flex; align-items:center; gap:12px; font-size:26px; font-weight:900; color:var(--primary); text-decoration:none; }
        .logo img { height: 50px; width: auto; transition: transform 0.3s ease; }
        .logo:hover img { transform: scale(1.1) rotate(-5deg); }
        .logo span { letter-spacing: 1px; }

        .nav-links { display:flex; gap:35px; list-style:none; align-items: center; }
        .nav-links a { 
            text-decoration:none; 
            color: var(--text-main); 
            font-weight: 600; 
            font-size: 15px; 
            transition: all 0.3s; 
            position: relative;
        }
        .nav-links a::after {
            content: '';
            position: absolute; bottom: -5px; left: 0; width: 0; height: 2px;
            background: var(--primary); transition: width 0.3s;
        }
        .nav-links a:hover { color: var(--primary); }
        .nav-links a:hover::after { width: 100%; }

        .login-btn {
            background: var(--primary);
            color: white !important;
            padding: 12px 28px;
            border-radius: 12px;
            font-size: 14px !important;
            box-shadow: 0 8px 15px rgba(0, 104, 116, 0.2);
            transition: all 0.3s !important;
        }
        .login-btn:hover { 
            background: var(--primary-dark);
            transform: translateY(-2px); 
            box-shadow: 0 12px 20px rgba(0, 104, 116, 0.3);
        }

        /* Hamburger */
        .hamburger { display: none; font-size: 24px; color: var(--primary); cursor: pointer; }

        /* ====== HERO ====== */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, rgba(0, 54, 61, 0.9) 0%, rgba(0, 104, 116, 0.7) 100%),
                url('https://images.unsplash.com/photo-1541339907198-e08756ebafe3?auto=format&fit=crop&q=80&w=2000') center/cover no-repeat fixed;
            display: flex; align-items: center; padding: 120px 8% 80px;
            color: white;
            position: relative;
        }
        .hero-content { max-width: 800px; position: relative; z-index: 2; }
        
        .hero-tag {
            display: inline-flex; align-items: center; gap: 10px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 10px 22px; border-radius: 50px; 
            font-size: 13px; font-weight: 800; 
            margin-bottom: 30px; 
            border: 1px solid rgba(255, 255, 255, 0.2);
            letter-spacing: 1px; text-transform: uppercase;
        }
        .hero-tag i { color: var(--secondary); }

        .hero h1 { 
            font-size: clamp(40px, 8vw, 84px); 
            font-weight: 900; 
            line-height: 1; 
            margin-bottom: 25px;
            text-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .hero h1 span { color: var(--secondary); background: linear-gradient(to right, #f6b553, #fff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        
        .hero p { 
            font-size: clamp(16px, 2.5vw, 20px); 
            opacity: 0.9; 
            max-width: 650px;
            line-height: 1.6; 
            margin-bottom: 45px;
            font-weight: 400;
        }

        .cta-group { display: flex; gap: 20px; flex-wrap: wrap; }
        .cta-btn {
            padding: 18px 36px; border-radius: 16px; font-size: 16px; font-weight: 700;
            text-decoration: none; transition: all 0.3s; display: inline-flex; align-items: center; gap: 10px;
        }
        .btn-gold { 
            background: var(--secondary); 
            color: #002023; 
            box-shadow: 0 10px 25px rgba(246, 181, 83, 0.3); 
        }
        .btn-gold:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 20px 40px rgba(246, 181, 83, 0.4); 
        }
        
        .btn-glass { 
            background: rgba(255, 255, 255, 0.12); 
            color: white; 
            border: 1px solid rgba(255, 255, 255, 0.2); 
            backdrop-filter: blur(8px); 
        }
        .btn-glass:hover { 
            background: rgba(255, 255, 255, 0.2); 
            transform: translateY(-5px);
        }

        /* Hero Stats */
        .hero-stats {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px; margin-top: 80px;
            border-top: 1px solid rgba(255, 255, 255, 0.1); padding-top: 50px;
            max-width: 700px;
        }
        .stat-item { text-align: left; }
        .stat-val { font-size: 42px; font-weight: 900; color: var(--secondary); display: block; line-height: 1; margin-bottom: 8px; }
        .stat-lbl { font-size: 12px; opacity: 0.7; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; }

        /* ====== SECTIONS ====== */
        .section { padding: 120px 8%; position: relative; }
        
        .section-header { text-align: center; margin-bottom: 80px; }
        .section-tag { 
            display: inline-block;
            font-size: 13px; font-weight: 800; color: var(--primary); 
            text-transform: uppercase; letter-spacing: 3px; 
            margin-bottom: 20px;
            background: var(--primary-light);
            padding: 8px 20px;
            border-radius: 50px;
        }
        .section-title { 
            font-size: clamp(32px, 5vw, 48px); 
            font-weight: 900; 
            color: var(--text-main); 
            margin-bottom: 20px; 
            letter-spacing: -1px;
        }
        .section-sub { 
            font-size: 18px; 
            color: var(--text-muted); 
            max-width: 650px; 
            margin: 0 auto;
            line-height: 1.7; 
        }

        /* ====== FEATURES ====== */
        .features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
        .feature-card {
            background: white; 
            padding: 50px 40px; 
            border-radius: 32px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); 
            border: 1px solid #f1f5f9;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .feature-card:hover { 
            transform: translateY(-15px); 
            box-shadow: 0 30px 60px rgba(0, 104, 116, 0.12);
            border-color: var(--primary-light);
        }
        .feature-icon {
            width: 75px; height: 75px; 
            background: var(--primary-light); 
            color: var(--primary);
            border-radius: 22px; 
            display: flex; align-items: center; justify-content: center;
            font-size: 32px;
            transition: all 0.3s;
        }
        .feature-card:hover .feature-icon { background: var(--primary); color: white; transform: rotate(-10deg); }
        .feature-card h3 { font-size: 24px; font-weight: 800; color: var(--text-main); }
        .feature-card p { font-size: 15px; color: var(--text-muted); line-height: 1.7; }

        /* ====== PRODI ====== */
        .prodi-section { background: #f1f5f9; }
        .prodi-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 25px; }
        .prodi-card {
            background: white;
            padding: 35px 25px; 
            border-radius: 28px; 
            text-align: center;
            border: 1px solid #e2e8f0;
            transition: all 0.4s; 
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }
        .prodi-card:hover { 
            background: var(--primary); 
            border-color: var(--primary); 
            transform: scale(1.05);
            box-shadow: 0 20px 40px rgba(0, 104, 116, 0.2);
        }
        .prodi-card i { font-size: 42px; color: var(--primary); transition: all 0.3s; }
        .prodi-card h4 { font-size: 17px; font-weight: 800; transition: all 0.3s; }
        .prodi-card span { font-size: 13px; color: var(--text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s; }
        
        .prodi-card:hover i, .prodi-card:hover h4, .prodi-card:hover span { color: white !important; }

        /* ====== CTA SECTION ====== */
        .cta-section {
            padding: 100px 8%;
            background: linear-gradient(rgba(0, 54, 61, 0.92), rgba(0, 84, 94, 0.95)), 
                        url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80&w=1920') center/cover no-repeat fixed;
            color: white; 
            text-align: center; 
            border-radius: 0;
            position: relative;
        }
        .cta-section h2 { font-size: clamp(32px, 6vw, 56px); font-weight: 900; margin-bottom: 25px; line-height: 1.1; }
        .cta-section p { font-size: 20px; opacity: 0.85; max-width: 700px; margin: 0 auto 50px; }

        /* ====== FOOTER ====== */
        footer {
            background: #00252a; 
            color: white;
            padding: 100px 8% 40px;
        }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1.5fr; gap: 60px; margin-bottom: 80px; }
        
        .footer-brand .logo { font-size: 28px; margin-bottom: 25px; color: white; display: flex; align-items: center; gap: 15px; }
        .footer-logo-box { background: white; padding: 10px; border-radius: 16px; width: 65px; height: 65px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px rgba(0,0,0,0.2); }
        .footer-brand .logo img { width: 100%; height: 100%; object-fit: contain; filter: none; }
        .footer-brand p { font-size: 15px; opacity: 0.6; line-height: 1.8; margin-bottom: 35px; max-width: 350px; }
        
        .social-links { display: flex; gap: 15px; }
        .social-links a {
            width: 48px; height: 48px; 
            background: rgba(255, 255, 255, 0.05); 
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center; 
            color: white; font-size: 18px;
            transition: all 0.3s; 
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .social-links a:hover { background: var(--secondary); color: #002023; transform: translateY(-5px) rotate(10deg); border-color: var(--secondary); }

        .footer-col h5 { font-size: 15px; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 30px; color: var(--secondary); }
        .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 15px; }
        .footer-col ul li a { text-decoration: none; color: rgba(255, 255, 255, 0.6); font-size: 15px; transition: all 0.3s; }
        .footer-col ul li a:hover { color: white; padding-left: 8px; }

        .footer-bottom { 
            border-top: 1px solid rgba(255, 255, 255, 0.08); 
            padding-top: 40px; 
            display: flex; justify-content: space-between; align-items: center; 
            flex-wrap: wrap; gap: 20px; 
        }
        .footer-bottom p { font-size: 14px; opacity: 0.4; font-weight: 500; }
        .footer-bottom .heart { color: #f43f5e; animation: pulse 1.5s infinite; display: inline-block; }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        /* ====== RESPONSIVE ====== */
        @media (max-width: 1200px) {
            .footer-grid { grid-template-columns: repeat(2, 1fr); gap: 40px; }
        }
        
        @media (max-width: 991px) {
            .nav-links { display: none; }
            .hamburger { display: block; }
            .features-grid { grid-template-columns: 1fr 1fr; }
            .hero-stats { grid-template-columns: repeat(3, 1fr); width: 100%; }
        }

        @media (max-width: 768px) {
            .hero { text-align: center; justify-content: center; }
            .hero-content { align-items: center; display: flex; flex-direction: column; }
            .cta-group { justify-content: center; }
            .features-grid { grid-template-columns: 1fr; }
            .section { padding: 80px 6%; }
            .footer-grid { grid-template-columns: 1fr; text-align: center; }
            .social-links { justify-content: center; }
            .footer-brand p { max-width: 100%; }
        }

        /* Mobile Menu */
        .mobile-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5); visibility: hidden; opacity: 0;
            z-index: 1100; transition: 0.3s; backdrop-filter: blur(5px);
        }
        .mobile-nav {
            position: fixed; top: 0; right: -300px; width: 300px; height: 100%;
            background: white; z-index: 1200; transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 80px 40px; display: flex; flex-direction: column; gap: 20px;
            box-shadow: -10px 0 30px rgba(0,0,0,0.1);
        }
        .mobile-nav.active { right: 0; }
        .mobile-overlay.active { visibility: visible; opacity: 1; }
        .mobile-nav a { text-decoration: none; color: var(--text-main); font-size: 18px; font-weight: 700; transition: 0.3s; }
        .mobile-nav a:hover { color: var(--primary); }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav id="navbar">
    <a href="<?= base_url() ?>" class="logo">
        <img src="<?= base_url('assets/kampus/logo.png') ?>" alt="UNIKI Logo">
        <span>UNIKI</span>
    </a>
    <ul class="nav-links">
        <li><a href="#beranda">Beranda</a></li>
        <li><a href="#keunggulan">Keunggulan</a></li>
        <li><a href="#prodi">Program Studi</a></li>
        <li><a href="<?= base_url('index.php/auth/login') ?>" class="login-btn">
            <i class="fa-solid fa-right-to-bracket"></i> SISFO Login
        </a></li>
    </ul>
    <div class="hamburger" onclick="toggleMobileNav()">
        <i class="fa-solid fa-bars-staggered"></i>
    </div>
</nav>

<!-- MOBILE NAV -->
<div class="mobile-overlay" id="mobileOverlay" onclick="toggleMobileNav()"></div>
<div class="mobile-nav" id="mobileNav">
    <a href="#beranda" onclick="toggleMobileNav()">Beranda</a>
    <a href="#keunggulan" onclick="toggleMobileNav()">Keunggulan</a>
    <a href="#prodi" onclick="toggleMobileNav()">Program Studi</a>
    <a href="<?= base_url('index.php/auth/login') ?>" style="color: var(--primary); margin-top:20px;">SISFO Login</a>
</div>

<!-- HERO -->
<section class="hero" id="beranda">
    <div class="hero-content">
        <div class="hero-tag">
            <i class="fa-solid fa-star"></i> Akreditasi Unggul BAN-PT • GLOBAL STANDARD
        </div>
        <h1>Sistem Absensi Digital<span> UNIKI</span></h1>
        <p>Membangun kedisiplinan dan transparansi akademik melalui sistem absensi cerdas berbasis QR-Code yang terintegrasi.</p>
        <div class="cta-group">
            <a href="https://uniki.ac.id/" class="cta-btn btn-gold"><i class="fa-solid fa-paper-plane"></i> Pendaftaran Online</a>
            <a href="#keunggulan" class="cta-btn btn-glass"><i class="fa-solid fa-circle-info"></i> Jelajahi Kampus</a>
        </div>
        <div class="hero-stats">
            <div class="stat-item">
                <span class="stat-val">12K+</span>
                <span class="stat-lbl">Mahasiswa</span>
            </div>
            <div class="stat-item">
                <span class="stat-val">32</span>
                <span class="stat-lbl">Prodi Pilihan</span>
            </div>
            <div class="stat-item">
                <span class="stat-val">500+</span>
                <span class="stat-lbl">Partner Industri</span>
            </div>
        </div>
    </div>
</section>

<!-- KEUNGGULAN -->
<section class="section" id="keunggulan">
    <div class="section-header">
        <span class="section-tag">Value & Excellence</span>
        <h2 class="section-title">Mengapa Memilih UNIKI?</h2>
        <p class="section-sub">Kami menghadirkan ekosistem belajar yang suportif dengan fasilitas mumpuni untuk mendukung aspirasi karir Anda.</p>
    </div>
    
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon"><i class="fa-solid fa-bolt"></i></div>
            <h3>Sistem Smart QR</h3>
            <p>Efisiensi kehadiran dengan teknologi QR-Code real-time yang terintegrasi langsung dengan portal nilai mahasiswa.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon"><i class="fa-solid fa-microchip"></i></div>
            <h3>Lab Teknologi Terpadu</h3>
            <p>Eksplorasi kreativitas Anda di laboratorium modern dengan perangkat high-end untuk simulasi industri nyata.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon"><i class="fa-solid fa-briefcase"></i></div>
            <h3>Career Development</h3>
            <p>Pendampingan karir intensif dan akses langsung ke ratusan partner industri strategis UNIKI di seluruh Indonesia.</p>
        </div>
    </div>
</section>

<!-- PROGRAM STUDI -->
<section class="section prodi-section" id="prodi">
    <div class="section-header">
        <span class="section-tag">Academic Hub</span>
        <h2 class="section-title">Program Studi Unggulan</h2>
        <p class="section-sub">Temukan jalur karir yang sesuai dengan minat Anda di berbagai fakultas terakreditasi kami.</p>
    </div>
    
    <div class="prodi-grid">
        <div class="prodi-card">
            <i class="fa-solid fa-code"></i>
            <h4>Teknik Informatika</h4>
            <span>S1 • Akreditasi Unggul</span>
        </div>
        <div class="prodi-card">
            <i class="fa-solid fa-chart-pie"></i>
            <h4>Manajemen Bisnis</h4>
            <span>S1 • Akreditasi Unggul</span>
        </div>
        <div class="prodi-card">
            <i class="fa-solid fa-plug-circle-bolt"></i>
            <h4>Teknik Elektro</h4>
            <span>S1 • Akreditasi A</span>
        </div>
        <div class="prodi-card">
            <i class="fa-solid fa-flask-vial"></i>
            <h4>Farmasi</h4>
            <span>S1 • Akreditasi A</span>
        </div>
        <div class="prodi-card">
            <i class="fa-solid fa-gavel"></i>
            <h4>Ilmu Hukum</h4>
            <span>S1 • Akreditasi Unggul</span>
        </div>
        <div class="prodi-card">
            <i class="fa-solid fa-compass-drafting"></i>
            <h4>Arsitektur</h4>
            <span>S1 • Akreditasi A</span>
        </div>
        <div class="prodi-card">
            <i class="fa-solid fa-stethoscope"></i>
            <h4>Kedokteran</h4>
            <span>S1 • Akreditasi Unggul</span>
        </div>
        <div class="prodi-card">
            <i class="fa-solid fa-wheat-awn"></i>
            <h4>Agribisnis</h4>
            <span>S1 • Akreditasi A</span>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section class="cta-section">
    <div style="position: relative; z-index: 2;">
        <h2>Wujudkan Impian Anda Bersama Kami</h2>
        <p>Bergabunglah dengan ribuan mahasiswa lainnya di universitas kebangsaan terbaik. Pendaftaran semester baru telah dibuka!</p>
        <div class="cta-group" style="justify-content: center;">
            <a href="#" class="cta-btn btn-gold"><i class="fa-solid fa-user-plus"></i> Daftar Sekarang</a>
            <a href="<?= base_url('index.php/auth/login') ?>" class="cta-btn btn-glass"><i class="fa-solid fa-right-to-bracket"></i> Login ke Portal</a>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="footer-grid">
        <div class="footer-brand">
            <a href="<?= base_url() ?>" class="logo">
                <div class="footer-logo-box">
                    <img src="<?= base_url('assets/kampus/logo.png') ?>" alt="UNIKI Logo">
                </div>
                <span>UNIKI ABSENSI</span>
            </a>
            <p>Universitas Kebangsaan Indonesia berdedikasi untuk menciptakan pemimpin masa depan melalui inovasi dan integritas akademik.</p>
            <div class="social-links">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
        
        <div class="footer-col">
            <h5>Akademik</h5>
            <ul>
                <li><a href="#">Program Diploma</a></li>
                <li><a href="#">Program Sarjana</a></li>
                <li><a href="#">Pascasarjana</a></li>
                <li><a href="#">e-Learning</a></li>
            </ul>
        </div>
        
        <div class="footer-col">
            <h5>Layanan</h5>
            <ul>
                <li><a href="#">Portal Mahasiswa</a></li>
                <li><a href="#">E-Library</a></li>
                <li><a href="#">Beasiswa</a></li>
                <li><a href="#">Legalitas Akreditasi</a></li>
            </ul>
        </div>
        
        <div class="footer-col">
            <h5>Kontak Kami</h5>
            <ul style="gap: 20px;">
                <li style="display: flex; gap: 15px; color: rgba(255,255,255,0.6); font-size: 14px;">
                    <i class="fa-solid fa-location-dot" style="color: var(--secondary); margin-top: 5px;"></i>
                    Jl. Medan- Banda Aceh Blang Bladeh<br>Aceh, Indonesia
                </li>
                <li style="display: flex; gap: 15px; color: rgba(255,255,255,0.6); font-size: 14px;">
                    <i class="fa-solid fa-phone" style="color: var(--secondary);"></i>
                    +62 21 1234 5678
                </li>
                <li style="display: flex; gap: 15px; color: rgba(255,255,255,0.6); font-size: 14px;">
                    <i class="fa-solid fa-envelope" style="color: var(--secondary);"></i>
                    info@uniki.ac.id
                </li>
            </ul>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; 2026 UNIKI - Universitas Kebangsaan Indonesia. All Rights Reserved.</p>
        <p>Made with <i class="fa-solid fa-heart heart"></i> for Bright Future.</p>
    </div>
</footer>

<script>
    // Navbar Scroll Effect
    window.addEventListener('scroll', function() {
        const nav = document.getElementById('navbar');
        if (window.scrollY > 50) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
    });

    // Mobile Nav Toggle
    function toggleMobileNav() {
        document.getElementById('mobileNav').classList.toggle('active');
        document.getElementById('mobileOverlay').classList.toggle('active');
    }
</script>

</body>
</html>
