<!-- Page Header -->
<div class="card-header no-print" style="margin-bottom: 30px; background: transparent; padding: 0; border: none; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
    <h3 class="card-title" style="font-size: 24px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 12px; margin: 0;">
        <i class="fa-solid fa-chalkboard-user" style="color: var(--primary);"></i> Panel Dashboard Dosen
    </h3>
    <span class="badge" style="padding: 8px 15px; border-radius: 12px; font-weight: 700; background: var(--primary-light); color: var(--primary); border: 1px solid rgba(0,0,0,0.05);">Semester Aktif 2026</span>
</div>

<!-- Welcome Hero Card -->
<div class="hero-identity" style="background: linear-gradient(135deg, #006874 0%, #004f58 100%); color: white; padding: 40px; border-radius: 35px; margin-bottom: 45px; position: relative; overflow: hidden; box-shadow: 0 20px 40px rgba(0, 104, 116, 0.15);">
    <div style="position: relative; z-index: 2; display: flex; align-items: center; gap: 25px; flex-wrap: wrap;" class="j-center">
        <div style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); padding: 5px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.3);">
            <?php 
            $foto = $this->session->userdata('foto');
            $img_src = (strpos($foto, 'http') === 0) ? $foto : base_url('assets/img/profile/').($foto ? $foto : 'default.png');
            ?>
            <img src="<?= $img_src ?>" style="width: 80px; height: 80px; border-radius: 15px; object-fit: cover; border: 2px solid white;">
        </div>
        <div style="flex: 1; min-width: 250px;" class="m-center">
            <span style="background: rgba(255, 255, 255, 0.2); padding: 4px 12px; border-radius: 50px; font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; display: inline-block;">
                Selamat Datang Kembali
            </span>
            <h2 style="color: white; margin-bottom: 5px; font-size: 28px; font-weight: 900; letter-spacing: -0.5px;">Bapak/Ibu <?= explode(' ', $this->session->userdata('nama'))[0] ?>!</h2>
            <p style="opacity: 0.9; font-size: 14px; font-weight: 500;">Pantau dan kelola kehadiran mahasiswa Anda melalui sistem QR-Code terpusat.</p>
        </div>
    </div>
    <i class="fa-solid fa-graduation-cap m-hide" style="position: absolute; right: -20px; bottom: -20px; font-size: 180px; color: rgba(255,255,255,0.1); z-index: 1; transform: rotate(-15deg);"></i>
</div>

<!-- Section Title -->
<div class="card-header" style="margin-bottom: 25px; border: none; background: transparent; padding: 0;">
    <h3 class="card-title" style="font-size: 18px; font-weight: 800; color: #475569;">
        <i class="fa-solid fa-layer-group" style="opacity: 0.5;"></i> Kelas Yang Diampu
    </h3>
</div>

<!-- Classes Grid -->
<div class="responsive-grid-dosen" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 20px;">
    <?php foreach($kelas->result() as $k): ?>
    <div class="card" style="margin-bottom: 0; padding: 30px; border-radius: 25px; border: 1px solid #f1f5f9; box-shadow: 0 10px 20px rgba(0,0,0,0.02); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); cursor: pointer;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.05)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.02)'">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
            <div style="display: flex; flex-direction: column; gap: 5px;">
                <span style="font-size: 10px; font-weight: 800; color: var(--primary); text-transform: uppercase;">Kode: <?= $k->kode_mk ?></span>
                <span class="badge" style="background: var(--primary-light); color: var(--primary); border: 1px solid #dcefe7;">KLS <?= $k->nama_kelas ?></span>
            </div>
            <div style="width: 40px; height: 40px; background: #f8fafc; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 18px; border: 1px solid #f1f5f9;">
                <i class="fa-solid fa-book-open"></i>
            </div>
        </div>
        
        <h4 style="margin-bottom: 15px; color: #1e293b; font-size: 18px; font-weight: 800; line-height: 1.3; min-height: 48px;"><?= $k->nama_mk ?></h4>
        
        <div style="display: flex; gap: 10px; margin-top: auto;">
            <a href="<?= base_url('index.php/dosen_fitur/pertemuan/'.$k->id_kelas) ?>" class="btn btn-primary" style="flex: 2; height: 45px; display: flex; align-items: center; justify-content: center; font-size: 12px;">
                Management
            </a>
            <a href="<?= base_url('index.php/dosen_fitur/mhs_kelas/'.$k->id_kelas) ?>" class="btn" style="flex: 0.5; background: #f1f5f9; color: #475569; border-radius: 14px; display: flex; align-items: center; justify-content: center; padding: 10px; border: 1px solid #e2e8f0; transition: all 0.3s;" title="Daftar Mahasiswa">
                <i class="fa-solid fa-users"></i>
            </a>
        </div>
    </div>
    <?php endforeach; ?>
    
    <?php if($kelas->num_rows() == 0): ?>
    <div style="grid-column: 1/-1; text-align: center; padding: 80px 20px; background: white; border-radius: 35px; border: 2px dashed #f1f5f9;">
        <h4 style="font-size: 18px; font-weight: 800; color: #475569;">Belum Ada Kelas</h4>
        <p style="color: #94a3b8; font-size: 13px;">Anda belum memiliki jadwal mengajar terdaftar.</p>
    </div>
    <?php endif; ?>
</div>

<style>
    @media (max-width: 768px) {
        .hero-identity { padding: 30px 20px !important; text-align: center; }
        .m-center { text-align: center !important; }
        .j-center { justify-content: center !important; }
        .m-hide { display: none; }
        .responsive-grid-dosen { grid-template-columns: 1fr !important; }
    }
</style>