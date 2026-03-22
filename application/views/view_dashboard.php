<!-- Hero Section - Neo Modern Branding -->
<div style="background: linear-gradient(135deg, rgba(0, 104, 116, 0.95), rgba(0, 79, 88, 1)), url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&q=80&w=1200') center center / cover no-repeat; padding: 100px 50px; border-radius: 40px; color: white; margin-bottom: 45px; position: relative; overflow: hidden; box-shadow: 0 25px 60px rgba(0, 104, 116, 0.25);">
    <div style="position: relative; z-index: 2; display: flex; align-items: center; gap: 40px;">
        <div style="background: white; padding: 20px; border-radius: 30px; width: 140px; height: 140px; display: flex; align-items: center; justify-content: center; box-shadow: 0 15px 35px rgba(0,0,0,0.3); border: 5px solid rgba(255,255,255,0.15); transition: transform 0.4s;" onmouseover="this.style.transform='scale(1.05) rotate(-5deg)'" onmouseout="this.style.transform='scale(1) rotate(0)'">
            <img src="<?= base_url('assets/kampus/logo.png') ?>" style="width: 100%; height: 100%; object-fit: contain;">
        </div>
        <div>
            <h1 style="font-size: 48px; font-weight: 900; margin-bottom: 8px; letter-spacing: -1px; line-height: 1.1;">
                Portal Presensi Terintegrasi
            </h1>
            <p style="font-size: 20px; opacity: 0.95; max-width: 700px; font-weight: 500; line-height: 1.6;">
                Selamat datang di sistem manajemen kehadiran digital <b>Universitas Kebangsaan Indonesia</b>. 
                Sederhanakan monitoring akademik Anda dengan teknologi QR-Code cerdas.
            </p>
        </div>
    </div>
    <i class="fa-solid fa-qrcode" style="position: absolute; right: -50px; bottom: -50px; font-size: 300px; color: rgba(255,255,255,0.03); z-index: 1;"></i>
</div>

<!-- Navigation Section -->
<div class="card-header" style="margin-bottom: 30px; background: transparent; padding: 0; border: none;">
    <h3 class="card-title" style="font-size: 20px; font-weight: 800; color: #1e293b;">
        <i class="fa-solid fa-compass" style="color: var(--primary);"></i> Jelajahi Modul Akademik
    </h3>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px; margin-bottom: 40px;">
    <!-- Modul Mahasiswa -->
    <a href="<?= base_url('index.php/mahasiswa') ?>" class="nav-card-link" style="text-decoration: none;">
        <div class="card nav-card">
            <div class="nav-card-icon" style="background: #eff6ff; color: #3b82f6;">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
            <h4 class="nav-card-title">Direktori Mahasiswa</h4>
            <p class="nav-card-desc">Kelola profil akademik mahasiswa, data angkatan, dan status registrasi semester.</p>
            <div class="nav-card-arrow"><i class="fa-solid fa-arrow-right-long"></i></div>
        </div>
    </a>

    <!-- Modul Dosen -->
    <a href="<?= base_url('index.php/dosen') ?>" class="nav-card-link" style="text-decoration: none;">
        <div class="card nav-card">
            <div class="nav-card-icon" style="background: #f0fdf4; color: #22c55e;">
                <i class="fa-solid fa-user-tie"></i>
            </div>
            <h4 class="nav-card-title">Manajemen Dosen</h4>
            <p class="nav-card-desc">Direktori tenaga pengajar, fungsionalitas pengampu MK, dan informasi departemen.</p>
            <div class="nav-card-arrow"><i class="fa-solid fa-arrow-right-long"></i></div>
        </div>
    </a>

    <!-- Modul Kurikulum -->
    <a href="<?= base_url('index.php/matakuliah') ?>" class="nav-card-link" style="text-decoration: none;">
        <div class="card nav-card">
            <div class="nav-card-icon" style="background: #eef2ff; color: #6366f1;">
                <i class="fa-solid fa-book-open-reader"></i>
            </div>
            <h4 class="nav-card-title">Sistem Kurikulum</h4>
            <p class="nav-card-desc">Atur struktur mata kuliah, beban SKS, serta prasayarat akademik program studi.</p>
            <div class="nav-card-arrow"><i class="fa-solid fa-arrow-right-long"></i></div>
        </div>
    </a>

    <!-- Modul Kelas & Jadwal -->
    <a href="<?= base_url('index.php/kelas') ?>" class="nav-card-link" style="text-decoration: none;">
        <div class="card nav-card">
            <div class="nav-card-icon" style="background: #fffbeb; color: #f59e0b;">
                <i class="fa-solid fa-calendar-star"></i>
            </div>
            <h4 class="nav-card-title">Penjadwalan Kuliah</h4>
            <p class="nav-card-desc">Manajemen jadwal perkuliahan, alokasi ruang kelas, dan monitoring presensi aktif.</p>
            <div class="nav-card-arrow"><i class="fa-solid fa-arrow-right-long"></i></div>
        </div>
    </a>
</div>

<style>
    .nav-card {
        padding: 40px 35px;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid #f1f5f9;
        margin-bottom: 0;
        position: relative;
        overflow: hidden;
    }
    .nav-card-link:hover .nav-card {
        transform: translateY(-12px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.06);
        border-color: var(--primary);
    }
    .nav-card-icon {
        width: 65px;
        height: 65px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin-bottom: 25px;
        transition: transform 0.3s;
    }
    .nav-card-link:hover .nav-card-icon {
        transform: scale(1.1);
    }
    .nav-card-title {
        font-size: 20px;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 12px;
    }
    .nav-card-desc {
        font-size: 14px;
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 30px;
        flex: 1;
    }
    .nav-card-arrow {
        font-size: 20px;
        color: var(--primary);
        opacity: 0;
        transform: translateX(-10px);
        transition: all 0.3s;
    }
    .nav-card-link:hover .nav-card-arrow {
        opacity: 1;
        transform: translateX(0);
    }
</style>