<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universitas Global Mandiri | Excellence in Education</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #006874;
            --primary-dark: #004f58;
            --secondary: #f6b553;
            --text-dark: #002023;
            --text-light: #4a6367;
            --white: #ffffff;
            --bg-glass: rgba(255, 255, 255, 0.9);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--white);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* Navbar */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 20px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--bg-glass);
            backdrop-filter: blur(10px);
            z-index: 1000;
            border-bottom: 2px solid rgba(0, 104, 116, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 24px;
            font-weight: 800;
            color: var(--primary);
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 35px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 16px;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .login-btn {
            background: var(--primary);
            color: white !important;
            padding: 12px 30px;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(0, 104, 116, 0.3);
            transition: all 0.3s;
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 104, 116, 0.4);
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(0, 104, 116, 0.7), rgba(0, 104, 116, 0.5)), url('https://images.unsplash.com/photo-1541339907198-e08756ebafe3?auto=format&fit=crop&q=80&w=2000');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            padding: 0 10%;
            color: white;
            text-align: left;
        }

        .hero-content {
            max-width: 800px;
        }

        .hero h1 {
            font-size: 72px;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 25px;
        }

        .hero p {
            font-size: 20px;
            opacity: 0.9;
            margin-bottom: 40px;
            max-width: 600px;
        }

        .cta-group {
            display: flex;
            gap: 20px;
        }

        .cta-btn {
            padding: 18px 45px;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-primary {
            background: var(--secondary);
            color: var(--text-dark);
        }

        .btn-outline {
            border: 2px solid white;
            color: white;
        }

        /* Features */
        .features {
            padding: 100px 10%;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            background: #f0f7f8;
        }

        .feature-card {
            background: white;
            padding: 50px 40px;
            border-radius: 30px;
            text-align: center;
            transition: all 0.3s;
            border: 1px solid rgba(0, 104, 116, 0.05);
        }

        .feature-card i {
            font-size: 50px;
            color: var(--primary);
            margin-bottom: 25px;
        }

        .feature-card h3 {
            margin-bottom: 15px;
            font-size: 24px;
        }

        .feature-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 30px 60px rgba(0, 104, 116, 0.1);
        }

        /* Footer */
        footer {
            background: var(--primary-dark);
            color: white;
            padding: 80px 10% 40px;
            text-align: center;
        }

        .footer-logo {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 30px;
            display: block;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 40px;
        }

        .social-links a {
            width: 50px;
            height: 50px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            transition: all 0.3s;
        }

        .social-links a:hover {
            background: var(--secondary);
            transform: rotate(360deg);
        }

        .copyright {
            opacity: 0.6;
            font-size: 14px;
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 30px;
        }
    </style>
</head>
<body>

    <nav>
        <a href="<?= base_url() ?>" class="logo">
            <i class="fa-solid fa-university"></i> UNIGLOBAL
        </a>
        <ul class="nav-links">
            <li><a href="<?= base_url('index.php/home') ?>">Beranda</a></li>
            <li><a href="#">Tentang</a></li>
            <li><a href="#">Akademik</a></li>
            <li><a href="#">Penerimaan</a></li>
            <li><a href="#">Kontak</a></li>
            <li><a href="<?= base_url('index.php/auth/login') ?>" class="login-btn">SISFO Login</a></li>
        </ul>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <h1>Membangun Masa Depan Gemilang.</h1>
            <p>Bergabunglah dengan komunitas akademik terbaik yang mengedepankan inovasi, integritas, dan teknologi dalam pendidikan tinggi.</p>
            <div class="cta-group">
                <a href="#" class="cta-btn btn-primary">Daftar Sekarang</a>
                <a href="#" class="cta-btn btn-outline">Lihat Program</a>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="feature-card">
            <i class="fa-solid fa-microchip"></i>
            <h3>Digital Campus</h3>
            <p>Fasilitas serba digital mulai dari absensi QR Code hingga perpustakaan online 24 jam.</p>
        </div>
        <div class="feature-card">
            <i class="fa-solid fa-award"></i>
            <h3>Akreditasi Unggul</h3>
            <p>Semua program studi telah terakreditasi Internasional dan Unggul oleh BAN-PT.</p>
        </div>
        <div class="feature-card">
            <i class="fa-solid fa-briefcase"></i>
            <h3>Karier Global</h3>
            <p>Bekerjasama dengan lebih dari 500 perusahaan multinasional untuk penempatan kerja lulusan.</p>
        </div>
    </section>

    <footer>
        <span class="footer-logo">UNIGLOBAL UNIVERSITY</span>
        <div class="social-links">
            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
            <a href="#"><i class="fa-brands fa-youtube"></i></a>
        </div>
        <p class="copyright">&copy; 2026 Universitas Global Mandiri. All Rights Reserved.</p>
    </footer>

</body>
</html>
