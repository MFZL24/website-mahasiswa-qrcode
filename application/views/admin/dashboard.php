<?php
    $admin_name = $this->session->userdata('nama');
?>

<!-- Header Section -->
<div class="card-header no-print" style="padding: 0; margin-bottom: 35px; border: none; background: transparent; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
    <div>
        <h3 class="card-title" style="font-size: 26px; font-weight: 900; color: #1e293b; display: flex; align-items: center; gap: 15px; margin-bottom: 5px; letter-spacing: -0.5px;">
            <i class="fa-solid fa-shield-halved" style="color: var(--primary);"></i> Command Center
        </h3>
        <p style="color: #64748b; font-size: 14px; margin: 0; font-weight: 500;">Monitor ekosistem akademik secara real-time.</p>
    </div>
    <div style="font-size: 12px; color: #94a3b8; font-weight: 850; display: flex; align-items: center; gap: 10px; background: white; padding: 10px 20px; border-radius: 14px; border: 1px solid #f1f5f9;">
        <i class="fa-solid fa-clock-rotate-left"></i> <?= date('d M Y') ?>
    </div>
</div>

<!-- Premium Hero Greeting -->
<div class="hero-identity" style="background: linear-gradient(135deg, #006874 0%, #004f58 100%); border-radius: 35px; padding: 40px; color: white; margin-bottom: 45px; position: relative; overflow: hidden; box-shadow: 0 25px 60px rgba(0, 104, 116, 0.25);">
    <div style="position: relative; z-index: 2; display: flex; align-items: center; gap: 30px; flex-wrap: wrap;" class="j-center">
        <!-- Admin Icon -->
        <div style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(15px); padding: 20px; border-radius: 30px; border: 1px solid rgba(255,255,255,0.2); margin: 0 auto;" class="m-center">
            <i class="fa-solid fa-user-shield" style="font-size: 45px; color: #f6b553;"></i>
        </div>

        <div style="flex: 1; min-width: 250px;" class="m-center">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px; flex-wrap: wrap;" class="j-center">
                <span style="background: rgba(246, 181, 83, 0.15); color: #f6b553; padding: 6px 14px; border-radius: 50px; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px;">
                    ROOT
                </span>
                <span style="background: rgba(255, 255, 255, 0.1); color: white; padding: 6px 14px; border-radius: 50px; font-size: 10px; font-weight: 800;">
                    SYSTEM ACTIVE
                </span>
            </div>
            <h2 style="color: white; margin-bottom: 10px; font-size: 32px; font-weight: 950; letter-spacing: -1px; line-height: 1.1;">Hello, <?= explode(' ', $admin_name)[0] ?>!</h2>
            <p style="opacity: 0.85; font-size: 14px; max-width: 550px; line-height: 1.6;">Selamat datang di pusat kontrol sistem administrasi akademik UNIKI.</p>
        </div>
    </div>
    <i class="fa-solid fa-microchip m-hide" style="position: absolute; right: -50px; bottom: -50px; font-size: 280px; color: rgba(255,255,255,0.04); z-index: 1; transform: rotate(-15deg);"></i>
</div>

<!-- Global Statistics Dashboard -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 40px;">
    <!-- Students Stats -->
    <div style="background: white; padding: 30px; border-radius: 30px; border: 1px solid #f1f5f9; display: flex; align-items: center; gap: 20px;">
        <div style="width: 60px; height: 60px; background: #eff6ff; color: #3b82f6; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 24px; border: 1px solid #dbeafe;">
            <i class="fa-solid fa-user-graduate"></i>
        </div>
        <div>
            <span style="font-size: 10px; font-weight: 850; color: #94a3b8; text-transform: uppercase;">Mahasiswa</span>
            <h2 style="font-size: 28px; font-weight: 950; color: #1e293b; line-height: 1;"><?= $total_mhs ?></h2>
        </div>
    </div>

    <!-- Lecturers Stats -->
    <div style="background: white; padding: 30px; border-radius: 30px; border: 1px solid #f1f5f9; display: flex; align-items: center; gap: 20px;">
        <div style="width: 60px; height: 60px; background: #ecfdf5; color: #10b981; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 24px; border: 1px solid #d1fae5;">
            <i class="fa-solid fa-user-tie"></i>
        </div>
        <div>
            <span style="font-size: 10px; font-weight: 850; color: #94a3b8; text-transform: uppercase;">Dosen</span>
            <h2 style="font-size: 28px; font-weight: 950; color: #1e293b; line-height: 1;"><?= $total_dosen ?></h2>
        </div>
    </div>

    <!-- Courses Stats -->
    <div style="background: white; padding: 30px; border-radius: 30px; border: 1px solid #f1f5f9; display: flex; align-items: center; gap: 20px;">
        <div style="width: 60px; height: 60px; background: #fffbeb; color: #eab308; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 24px; border: 1px solid #fef3c7;">
            <i class="fa-solid fa-book-bookmark"></i>
        </div>
        <div>
            <span style="font-size: 10px; font-weight: 850; color: #94a3b8; text-transform: uppercase;">Matakuliah</span>
            <h2 style="font-size: 28px; font-weight: 950; color: #1e293b; line-height: 1;"><?= $total_mk ?></h2>
        </div>
    </div>
</div>

<!-- Administrative Control Panel -->
<div class="admin-grid" style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px; align-items: start;">
    
    <!-- Global Configuration -->
    <div style="display: flex; flex-direction: column; gap: 30px;">
        <div class="card" style="border-radius: 30px; padding: 30px; background: white;">
            <h4 style="color: #1e293b; font-weight: 900; margin-bottom: 25px; display: flex; align-items: center; gap: 12px; font-size: 16px;">
                <i class="fa-solid fa-sliders" style="color: var(--primary);"></i> Portal Config
            </h4>
            
            <div style="background: #f8fafc; padding: 6px; border-radius: 18px; display: grid; grid-template-columns: 1fr 1fr; gap: 8px; border: 1px solid #f1f5f9; margin-bottom: 15px;">
                <a href="<?= base_url('index.php/dashboard/set_semester/ganjil') ?>" 
                   style="text-align: center; padding: 12px; border-radius: 15px; font-weight: 800; font-size: 11px; text-decoration: none; transition: all 0.3s; <?= $semester_aktif == 'ganjil' ? 'background: var(--primary); color: white;' : 'color: #94a3b8;' ?>">
                   GANJIL
                </a>
                <a href="<?= base_url('index.php/dashboard/set_semester/genap') ?>" 
                   style="text-align: center; padding: 12px; border-radius: 15px; font-weight: 800; font-size: 11px; text-decoration: none; transition: all 0.3s; <?= $semester_aktif == 'genap' ? 'background: var(--primary); color: white;' : 'color: #94a3b8;' ?>">
                   GENAP
                </a>
            </div>
            
            <div style="background: #fafbfc; border-radius: 15px; padding: 15px; text-align: center; border: 1px solid #f1f5f9;">
                <div style="font-size: 12px; font-weight: 800; color: var(--primary);">ACTIVE: <?= strtoupper($semester_aktif) ?></div>
            </div>
        </div>
    </div>

    <!-- Verification Queue -->
    <div class="card" style="border-radius: 30px; padding: 0; background: white; overflow: hidden;">
        <div class="card-header" style="background: #fafbfc; padding: 25px 30px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
            <h3 class="card-title" style="margin: 0; font-size: 16px; font-weight: 950; color: #be185d;">
                <i class="fa-solid fa-stamp" style="margin-right: 10px;"></i> Verifikasi Akun Baru
            </h3>
        </div>

        <div style="padding: 25px;">
            <?php if(count($pending_mhs) > 0 || count($pending_dosen) > 0): ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
                <!-- Pending Items logic remains the same but with compact styles -->
                <?php foreach(array_merge($pending_mhs, $pending_dosen) as $p): ?>
                <div style="background: #f8fafc; padding: 15px; border-radius: 18px; border: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
                    <div style="min-width: 0;">
                        <div style="font-weight: 800; font-size: 14px; color: #1e293b; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?= $p->nama ?></div>
                        <div style="font-size: 10px; color: #94a3b8; font-weight: 700;"><?= strtoupper($p->role) ?></div>
                    </div>
                    <?php 
                        $url = ($p->role == 'mahasiswa') ? 'mahasiswa/activate/' : 'dosen/activate/';
                    ?>
                    <a href="<?= base_url('index.php/'.$url.$p->id_operator) ?>" class="btn-verify" style="background: #10b981; color: white; padding: 8px 12px; border-radius: 10px; font-size: 10px; font-weight: 800; text-decoration: none;">SETUJUI</a>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div style="text-align: center; padding: 40px 20px;">
                <i class="fa-solid fa-clipboard-check" style="font-size: 40px; color: #cbd5e1; margin-bottom: 15px; display: block;"></i>
                <p style="color: #94a3b8; font-size: 13px;">Semua pendaftaran telah diproses.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .admin-grid { grid-template-columns: 1fr !important; }
        .hero-identity { padding: 30px 20px !important; text-align: center; }
        .m-center { text-align: center !important; }
        .j-center { justify-content: center !important; }
        .m-hide { display: none; }
    }
</style>

<style>
    .btn-verify:hover {
        background: #10b981 !important;
        color: white !important;
        border-color: #10b981 !important;
        transform: scale(1.05);
        box-shadow: 0 8px 15px rgba(16, 185, 129, 0.2);
    }
    .custom-scroll::-webkit-scrollbar { width: 4px; }
    .custom-scroll::-webkit-scrollbar-track { background: transparent; }
    .custom-scroll::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    .custom-scroll::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
</style>